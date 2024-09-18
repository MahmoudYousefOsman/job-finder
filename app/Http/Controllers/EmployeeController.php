<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatusEnum;
use App\Enums\UserTypeEnum;
use App\Http\Requests\EmployeeRegisterRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{


    public function index()
    {
        $jobs = Job::with('employer')->withCount(['applications'])->orderBy('applications_count')->take(4)->get();
        return view('index', compact('jobs'));
    }


    public function find(Request $request)
    {
        $categories = Category::all();
        $skills = Skill::select(['name'])->distinct()->get();
        $jobs = Job::with('employer')->withCount(['applications'])
            ->where('expired_at', '>=', today())
            ->when($request->category_id, fn($query, $value) => $query->where('category_id', $value))
            ->when($request->salart_from, fn($query, $value) => $query->where('salary_start', '<=', $value))
            ->when($request->salart_to, fn($query, $value) => $query->where('salary_start', '>=', $value))
            ->when($request->created_at, fn($query, $value) => $query->where('created_at', '>=', $value))
            ->when($request->skill_id, fn(Builder $query, $value) => $query->whereRelation('skills', 'name', $value))
            ->when($request->location, fn(Builder $query, $value) => $query->where('location', 'like', "%$value%"))
            ->when($request->search, function (Builder $query, $value) {
                return $query->where(function (Builder $query) use ($value) {
                    $query->where('title', 'like', '%' . $value . '%')
                        ->orWhere('description', 'like', '%' . $value . '%');
                });
            })
            ->paginate(7);
        return view('job_listing', compact('categories', 'skills', 'jobs'));
    }

    public function job(Job $job)
    {
        return view('job_details', compact('job'));
    }

    public function apply(Request $request, Job $job)
    {
        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf'],
        ]);
        $cv = $request->file('cv')->store('cvs');
        auth()->user()->applications()->create([
            'job_id' => $job->id,
            'resume' => $cv,
        ]);
        return redirect()->route('job', $job)->with('success', 'Your application has been submitted');
    }

    public function applications()
    {
        $applications = auth()->user()->applications()->with(['job.employer'])->latest()->paginate(10);
        return view('applications', compact('applications'));
    }

    public function registerForm()
    {
        return view('register');
    }

    public function doRegister(EmployeeRegisterRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('users');
        $user = User::create($data);
        auth()->login($user);
        return redirect()->route('home');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password') + ['type' => UserTypeEnum::Employee->value];
        if (!auth()->attempt($credentials)) {
            return back()->withErrors([
                'credentials' => 'Email or password is incorrect',
            ]);
        }
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(EmployeeRegisterRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            auth()->user()->deleteImage();
            $data['image'] = $request->file('image')->store('users');
        } else {
            unset($data['image']);
        }
        if (!$request->filled('password')) {
            unset($data['password']);
        }
        auth()->user()->update($data);
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');

    }

    public function cancel(Job $job)
    {
        $app = auth()->user()->applications()->where('job_id', $job->id)->first();
        $app->update([
            'status' => ApplicationStatusEnum::CancelByEmployee,
        ]);
        return back()->with('success', 'Your application has been cancelled');

    }
}

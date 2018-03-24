<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Location
use App\Repositories\Location\LocationRepository;
use App\Repositories\Location\EloquentLocationRepository;
// country
use App\Repositories\Country\CountryRepository;
use App\Repositories\Country\EloquentCountryRepository;
//Currency
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Currency\EloquentCurrencyRepository;
//Industry
use App\Repositories\Industry\IndustryRepository;
use App\Repositories\Industry\EloquentIndustryRepository;
//CompanySize
use App\Repositories\CompanySize\CompanySizeRepository;
use App\Repositories\CompanySize\EloquentCompanySizeRepository;
//CompanyProfile
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\CompanyProfile\EloquentCompanyProfileRepository;
//User
use App\Repositories\User\UserRepository;
use App\Repositories\User\EloquentUserRepository;
//JobSeeker
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\JobSeeker\EloquentJobSeekerRepository;
//CompanyImage
use App\Repositories\CompanyImage\CompanyImageRepository;
use App\Repositories\CompanyImage\EloquentCompanyImageRepository;
//Job
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\EloquentJobRepository;
//Skill
use App\Repositories\Skill\SkillRepository;
use App\Repositories\Skill\EloquentSkillRepository;
//JobSeekerExperience
use App\Repositories\JobSeekerExperience\JobSeekerExperienceRepository;
use App\Repositories\JobSeekerExperience\EloquentJobSeekerExperienceRepository;
//CompanyReview
use App\Repositories\CompanyReview\CompanyReviewRepository;
use App\Repositories\CompanyReview\EloquentCompanyReviewRepository;
//CompanyIndustry
use App\Repositories\CompanyIndustry\CompanyIndustryRepository;
use App\Repositories\CompanyIndustry\EloquentCompanyIndustryRepository;
//JobSeekerSkill
use App\Repositories\JobSeekerSkill\JobSeekerSkillRepository;
use App\Repositories\JobSeekerSkill\EloquentJobSeekerSkillRepository;

//JobActStatic
use App\Repositories\JobActstatic\JobActstaticRepository;
use App\Repositories\JobActstatic\EloquentJobActstaticRepository;

//JobSkill
use App\Repositories\JobSkill\JobSkillRepository;
use App\Repositories\JobSkill\EloquentJobSkillRepository;
//Notification
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Notification\EloquentNotificationRepository;
//SavedJob
use App\Repositories\SavedJob\SavedJobRepository;
use App\Repositories\SavedJob\EloquentSavedJobRepository;
//AppliedJob
use App\Repositories\AppliedJob\AppliedJobRepository;
use App\Repositories\AppliedJob\EloquentAppliedJobRepository;
//feedback
use App\Repositories\Feedback\FeedbackRepository;
use App\Repositories\Feedback\EloquentFeedbackRepository;
//category
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
//shortlist
use App\Repositories\Shortlist\ShortlistRepository;
use App\Repositories\Shortlist\EloquentShortlistRepository;

//Interview
use App\Repositories\Interview\InterviewRepository;
use App\Repositories\Interview\EloquentInterviewRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
        //location
        $this->app->singleton(LocationRepository::class, EloquentLocationRepository::class);
        //country
        $this->app->singleton(CountryRepository::class, EloquentCountryRepository::class);
        //Currency
        $this->app->singleton(CurrencyRepository::class, EloquentCurrencyRepository::class);
        //Industry
        $this->app->singleton(IndustryRepository::class, EloquentIndustryRepository::class);
        //CompanySize
        $this->app->singleton(CompanySizeRepository::class, EloquentCompanySizeRepository::class);
        //CompanyProfile
        $this->app->singleton(CompanyProfileRepository::class, EloquentCompanyProfileRepository::class);
        //User
        $this->app->singleton(UserRepository::class, EloquentUserRepository::class);
        //JobSeeker
        $this->app->singleton(JobSeekerRepository::class, EloquentJobSeekerRepository::class);
        //CompanyImage
        $this->app->singleton(CompanyImageRepository::class, EloquentCompanyImageRepository::class);
        //Job
        $this->app->singleton(JobRepository::class, EloquentJobRepository::class);
        //Skill
        $this->app->singleton(SkillRepository::class, EloquentSkillRepository::class);
        // /JobSeekerExperience
        $this->app->singleton(JobSeekerExperienceRepository::class, EloquentJobSeekerExperienceRepository::class);
        //CompanyReview
        $this->app->singleton(CompanyReviewRepository::class, EloquentCompanyReviewRepository::class);
        //CompanyIndustry
        $this->app->singleton(CompanyIndustryRepository::class, EloquentCompanyIndustryRepository::class);
        //JobSeekerSkill
        $this->app->singleton(JobSeekerSkillRepository::class, EloquentJobSeekerSkillRepository::class);
        //JobActstatic
        $this->app->singleton(JobActstaticRepository::class, EloquentJobActstaticRepository::class);
        //JobSkill
        $this->app->singleton(JobSkillRepository::class, EloquentJobSkillRepository::class);
        //Notification
        $this->app->singleton(NotificationRepository::class, EloquentNotificationRepository::class);
        //SavedJob
        $this->app->singleton(SavedJobRepository::class, EloquentSavedJobRepository::class);
        //AppliedJob
        $this->app->singleton(AppliedJobRepository::class, EloquentAppliedJobRepository::class);
        //feedback
        $this->app->singleton(FeedbackRepository::class, EloquentFeedbackRepository::class);
        //category
        $this->app->singleton(CategoryRepository::class, EloquentCategoryRepository::class);
        //shortlist
        $this->app->singleton(ShortlistRepository::class, EloquentShortlistRepository::class);
        //interview
        $this->app->singleton(InterviewRepository::class, EloquentInterviewRepository::class);
    }
}

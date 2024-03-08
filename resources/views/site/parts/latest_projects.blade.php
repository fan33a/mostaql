<div class="container">
    <!-- Section Tittle -->
    <div class="row">
        <div class="col-lg-12">
            <div class="section-tittle text-center">
                <span>Recent Job</span>
                <h2>Featured Jobs</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-10">
            @foreach ($latest_projects as $project)
                                        <!-- single-job-content -->
            <div class="single-job-items mb-30">
                <div class="job-items">
                    {{-- <div class="company-img">
                        <a href="job_details.html"><img src=" {{ asset('siteassets/img/icon/job-list1.png') }}" alt=""></a>
                    </div> --}}
                    <div class="job-tittle">
                        <a href="job_details.html"><h4>{{ $project->trans_name . '-' . $project->id }}</h4></a>
                        <ul>
                            <li>Creative Agency</li>
                            <li><i class="fas fa-map-marker-alt"></i>Athens, Greece</li>
                            <li>$3500 - $4000</li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    <a href="job_details.html">Full Time</a>
                    <span>7 hours ago</span>
                </div>
            </div>
            @endforeach
            <div class="nav-wrapper">
                {{ $latest_projects->links() }}
            </div>
        </div>
    </div>
</div>
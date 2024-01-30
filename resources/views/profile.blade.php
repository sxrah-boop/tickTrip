
@include('includes.header')
    <div class="container py-6 rounded-2" style="background-color: #380094; padding: 6rem;padding-top: 1rem;">
        <h1 class="text-light text-center py-3">My Profile</h1>
        <div class="row gutters">
        
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-30">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="images/navbar/profile.svg" alt="Profile Image">
                                </div>
                                <h5 class="user-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h5>
                                <h6 class="user-email">{{ Auth::user()->email }}</h6>
                            </div>
                         
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 fw-bold">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="firstname">First name</label>
                                    <input type="text" class="form-control" id="firstname" placeholder=""
                                        value="{{ Auth::user()->firstname }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" class="form-control" id="lastname" placeholder=""
                                        value="{{ Auth::user()->lastname }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder=""
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-4">
                                <div class="form-group">
                                    <label for="matricule">Matricule</label>
                                    <input type="text" class="form-control" id="matricule" placeholder=""
                                        value="{{ Auth::user()->matricule }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder=""
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>                        
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-4">
                                <div class="form-group">
                                    <label for="wilaya">Wilaya</label>
                                    <select class="form-select" id="wilaya" name="wilaya">
                                        <!-- Add options for each wilaya -->
                                        <option value="" selected disabled>select wilaya</option>
                                        <option value="Adrar">Adrar</option>
                                        <option value="Chlef">Chlef</option>
                                        <option value="Laghouat">Laghouat</option>
                                        <!-- ... -->
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4 ">
                                <h6 class="mb-3 fw-bold">Update Password</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="oldPassword">Old Password</label>
                                    <input type="password" class="form-control" id="oldPassword" placeholder="Enter old password">
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ">
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-secondary">Cancel</button>
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('includes.footer')
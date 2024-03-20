@extends('dashboard.auth.app')
@section('content')
		<div class="page login-bg">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-5">
									<div class="card">
										<div class="p-4 pt-6 text-center">
											<h1 class="mb-2">Register</h1>
											<p class="text-muted">Create new account</p>
										</div>
										<form class="card-body pt-3" id="rgister" name="register">
											<div class="form-group">
											<label class="">Username</label>
												<div class="input-group mb-4">
													<div class="input-group">
														<span class="input-group-text">
															<i class="fe fe-user""></i>
														</span>
														<input class="form-control" placeholder="Email">
													</div>
												</div>
											</div>
											<div class="form-group">
											<label class="">Mail or Username</label>
												<div class="input-group mb-4">
													<div class="input-group">
														<span class="input-group-text">
															<i class="fe fe-mail""></i>
														</span>
														<input class="form-control" placeholder="Email">
													</div>
												</div>
											</div>
											<div class="form-group">
											<label class="form-label">Password</label>
												<div class="input-group mb-4">
													<div class="input-group" id="Password-toggle">
														<a href="" class="input-group-text">
															<i class="fe fe-eye-off" aria-hidden="true"></i>
														</a>
														<input class="form-control" type="password" placeholder="Password">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
													<span class="custom-control-label">I agree to the <a href="#" class="text-primary">Terms of services</a> and <a href="#" class="text-primary">Privacy policy</a></span>
												</label>
											</div>
											<div class="submit">
												<a class="btn btn-primary btn-block" href="index.html">Create Account</a>
											</div>
											<div class="text-center mt-4">
												<p class="text-dark mb-0">Already have an account?<a class="text-primary ms-1" href="#">LogIn</a></p>
											</div>
										</form>
										<div class="card-body border-top-0 pb-6 pt-2">
											<div class="text-center">
												<span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-facebook-line"></i></span>
												<span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-instagram-line"></i></span>
												<span class="avatar brround me-3 bg-primary-transparent text-primary"><i class="ri-twitter-line"></i></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection()

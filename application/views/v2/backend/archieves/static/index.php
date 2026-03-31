<link href="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css" rel="stylesheet">

<div class="page-titles">
     <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Daftar Arsip</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Statis</a></li>
     </ol>
</div>
<!-- row -->
<div class="row">
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-primary text-primary">
                              <!-- <i class="ti-user"></i> -->
                              <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                   <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                   <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Total</p>
                              <h4 class="mb-0">3280</h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-warning text-warning">
                              <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                   <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                   <polyline points="14 2 14 8 20 8"></polyline>
                                   <line x1="16" y1="13" x2="8" y2="13"></line>
                                   <line x1="16" y1="17" x2="8" y2="17"></line>
                                   <polyline points="10 9 9 9 8 9"></polyline>
                              </svg>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Statis</p>
                              <h4 class="mb-0">2570</h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body  p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-danger text-danger">
                              <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                   <line x1="12" y1="1" x2="12" y2="23"></line>
                                   <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                              </svg>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">Verifikasi</p>
                              <h4 class="mb-0">364</h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xxl-3 col-lg-3 col-sm-6">
          <div class="widget-stat card">
               <div class="card-body p-4">
                    <div class="media ai-icon">
                         <span class="me-3 bgl-success text-success">
                              <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                   <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                   <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                   <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                              </svg>
                         </span>
                         <div class="media-body">
                              <p class="mb-1">TTE</p>
                              <h4 class="mb-0">364</h4>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-lg-12">
          <div class="filter cm-content-box box-primary">
               <div class="content-title">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
                    </div>
                    <div class="tools">
                         <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
               </div>
               <div class="cm-content-body form excerpt">
                    <div class="card-body">
                         <div class="row">
                              <div class="col-xl-3 col-sm-6">
                                   <input type="text" class="form-control mb-xl-0 mb-3" id="exampleFormControlInput1" placeholder="Title">
                              </div>
                              <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                   <select class="form-control default-select dashboard-select-2 h-auto wide" aria-label="Default select example">
                                        <option selected>Select Status</option>
                                        <option value="1">Published</option>
                                        <option value="2">Draft</option>
                                        <option value="3">Trash</option>
                                        <option value="4">Private</option>
                                        <option value="5">Pending</option>
                                   </select>
                              </div>
                              <div class="col-xl-3 col-sm-6">
                                   <input id="datepicker" class=" form-control mb-xl-0 mb-3">
                              </div>
                              <div class="col-xl-3 col-sm-6">
                                   <button class="btn btn-primary btn-filter" title="Klik disini untuk mencari" type="button"><i class="fa fa-search me-1"></i>Filter</button>
                                   <button class="btn btn-danger light btn-reset" title="Klik disini untuk menghapus filter" type="button">Reset</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-12">
          <div class="filter cm-content-box box-primary">
               <div class="content-title">
                    <div class="cpa">
                         <i class="fa-sharp fa-solid fa-file-alt me-2"></i>Daftar Arsip Statis
                    </div>
                    <div class="align-middle">
                         <a href="<?= base_url('v2/backend/dashboards/add_static_archieves') ?>" class="btn btn-primary btn-sm"><i class="fal fa-plus me-1"></i> Tambah Arsip Statis</a>
                    </div>
               </div>
               <div class="card-body pt-0">
                    <div class="table-responsive">
                         <table id="example5" class="display" style="min-width: 845px">
                              <thead>
                                   <tr>
                                        <th>
                                             <!-- <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                  <label class="custom-control-label" for="checkAll"></label>
                                             </div> -->
                                             No.
                                        </th>
                                        <th>Order ID</th>
                                        <th>Date Check in</th>
                                        <th>Name</th>
                                        <th>Assgined</th>
                                        <th>Disease</th>
                                        <th>Status</th>
                                        <th>Table no</th>
                                        <th class="text-end">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
                                                  <label class="custom-control-label" for="customCheckBox2"></label>
                                             </div>
                                        </td>
                                        <td>#P-00001</td>
                                        <td class="w-space-no">26/02/2020, 12:42 AM</td>
                                        <td>Tiger Nixon</td>
                                        <td>Dr. Cedric</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-001</td>
                                        <td>
                                             <div class="d-flex">
                                                  <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                  <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox3" required="">
                                                  <label class="custom-control-label" for="customCheckBox3"></label>
                                             </div>
                                        </td>
                                        <td>#P-00002</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Garrett Winters</td>
                                        <td>Dr. Cedric</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-002</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox4" required="">
                                                  <label class="custom-control-label" for="customCheckBox4"></label>
                                             </div>
                                        </td>
                                        <td>#P-00003</td>
                                        <td>26/02/2020, 12:42 AM</td>
                                        <td>Ashton Cox</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-success">
                                                  <i class="fa fa-circle text-success me-1"></i>
                                                  Recovered
                                             </span>
                                        </td>
                                        <td>AB-003</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox5" required="">
                                                  <label class="custom-control-label" for="customCheckBox5"></label>
                                             </div>
                                        </td>
                                        <td class="w-space-no">#P-00004</td>
                                        <td>29/02/2020, 12:42 AM</td>
                                        <td>Ashton Cox</td>
                                        <td>Dr. Cedric</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-004</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox6" required="">
                                                  <label class="custom-control-label" for="customCheckBox6"></label>
                                             </div>
                                        </td>
                                        <td>#P-00005</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Ashton Cox</td>
                                        <td>Dr. Cedric</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-005</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox7" required="">
                                                  <label class="custom-control-label" for="customCheckBox7"></label>
                                             </div>
                                        </td>
                                        <td>#P-00006</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Ashton Cox</td>
                                        <td>Dr. Rhona</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-006</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox8" required="">
                                                  <label class="custom-control-label" for="customCheckBox8"></label>
                                             </div>
                                        </td>
                                        <td>#P-00007</td>
                                        <td>26/02/2020, 12:42 AM</td>
                                        <td>Airi Satou</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-007</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox9" required="">
                                                  <label class="custom-control-label" for="customCheckBox9"></label>
                                             </div>
                                        </td>
                                        <td>#P-00008</td>
                                        <td>29/02/2020, 12:42 AM</td>
                                        <td>Airi Satou</td>
                                        <td>Dr. Garrett </td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-008</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox10" required="">
                                                  <label class="custom-control-label" for="customCheckBox10"></label>
                                             </div>
                                        </td>
                                        <td>#P-00009</td>
                                        <td>25/02/2020, 12:42 AM</td>
                                        <td>Airi Satou</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-009</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox11" required="">
                                                  <label class="custom-control-label" for="customCheckBox11"></label>
                                             </div>
                                        </td>
                                        <td>#P-00010</td>
                                        <td>26/02/2020, 12:42 AM</td>
                                        <td>Airi Satou</td>
                                        <td>Dr. Rhona</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-010</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox12" required="">
                                                  <label class="custom-control-label" for="customCheckBox12"></label>
                                             </div>
                                        </td>
                                        <td>#P-00011</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Airi Satou</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-011</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox13" required="">
                                                  <label class="custom-control-label" for="customCheckBox13"></label>
                                             </div>
                                        </td>
                                        <td>#P-00012</td>
                                        <td>29/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Garrett</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-012</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox14" required="">
                                                  <label class="custom-control-label" for="customCheckBox14"></label>
                                             </div>
                                        </td>
                                        <td>#P-00013</td>
                                        <td>25/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-013</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox15" required="">
                                                  <label class="custom-control-label" for="customCheckBox15"></label>
                                             </div>
                                        </td>
                                        <td>#P-00014</td>
                                        <td>26/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Garrett</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-014</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox16" required="">
                                                  <label class="custom-control-label" for="customCheckBox16"></label>
                                             </div>
                                        </td>
                                        <td>#P-00015</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-015</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox17" required="">
                                                  <label class="custom-control-label" for="customCheckBox17"></label>
                                             </div>
                                        </td>
                                        <td>#P-00016</td>
                                        <td>29/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Garrett</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-016</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox18" required="">
                                                  <label class="custom-control-label" for="customCheckBox18"></label>
                                             </div>
                                        </td>
                                        <td>#P-00017</td>
                                        <td>25/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-017</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox19" required="">
                                                  <label class="custom-control-label" for="customCheckBox19"></label>
                                             </div>
                                        </td>
                                        <td>#P-00018</td>
                                        <td>26/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Rhona</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-018</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox20" required="">
                                                  <label class="custom-control-label" for="customCheckBox20"></label>
                                             </div>
                                        </td>
                                        <td>#P-00019</td>
                                        <td>28/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Rhona</td>
                                        <td>Cold & Flu</td>
                                        <td>
                                             <span class="badge light badge-danger">
                                                  <i class="fa fa-circle text-danger me-1"></i>
                                                  New Patient
                                             </span>
                                        </td>
                                        <td>AB-019</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div class="custom-control custom-checkbox ms-2">
                                                  <input type="checkbox" class="custom-control-input" id="customCheckBox21" required="">
                                                  <label class="custom-control-label" for="customCheckBox21"></label>
                                             </div>
                                        </td>
                                        <td>#P-00020</td>
                                        <td>25/02/2020, 12:42 AM</td>
                                        <td>Sonya Frost</td>
                                        <td>Dr. Garrett</td>
                                        <td>Sleep Problem</td>
                                        <td>
                                             <span class="badge light badge-warning">
                                                  <i class="fa fa-circle text-warning me-1"></i>
                                                  In Treatment
                                             </span>
                                        </td>
                                        <td>AB-020</td>
                                        <td>
                                             <div class="dropdown ms-auto text-end c-pointer">
                                                  <div class="btn-link" data-bs-toggle="dropdown">
                                                       <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                 <rect x="0" y="0" width="24" height="24"></rect>
                                                                 <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                 <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                       </svg>
                                                  </div>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a class="dropdown-item" href="#">Accept Patient</a>
                                                       <a class="dropdown-item" href="#">Reject Order</a>
                                                       <a class="dropdown-item" href="#">View Details</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Required vendors -->
<script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>

<script src="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/v3/backend/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script>
     $("#datepicker").datepicker({
          autoclose: true,
          todayHighlight: true
     }).datepicker('update', new Date());

     // let archieve_static = $('#archieves-table').DataTable({
     //      responsive: false,
     //      searching: true,
     //      processing: true,
     //      serverSide: true,
     //      paging: true,
     //      language: {
     //           paginate: {
     //                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
     //                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
     //           }
     //      }
     // });

     var table = $('#example5').DataTable({
          searching: false,
          paging: true,
          select: false,
          info: true,
          lengthChange: false,
          language: {
               paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
               }
          }

     });
</script>

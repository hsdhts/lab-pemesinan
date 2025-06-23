<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Kernel Hydrocyclone</h1>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Shift</th>
                                    <th class="min-w-120px">Nama Operator</th>
                                    <th class="min-w-100px">Sample Waight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kernel_hydrocyclones as $key => $kernel)
                                <tr>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $key + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $kernel->shift }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $kernel->nama_operator }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $kernel->sample_weight }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_3">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Hydrocyclone Losses</h1>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">No</th>
                                    <th class="min-w-150px">Shift</th>
                                    <th class="min-w-120px">Nama Operator</th>
                                    <th class="min-w-100px">Sample Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hydrocyclone_losses as $key => $losses)
                                <tr>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $key + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $losses->shift }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $losses->nama_operator }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $losses->sample_weight }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_3">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Mesin</h1>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                								<!--begin::Tables Widget 13-->

									<!--begin::Body-->
									<div class="card-body py-3">
										<!--begin::Table container-->
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
												<!--begin::Table head-->
												<thead>
													<tr class="fw-bolder text-muted">
														<th class="min-w-140px">Mesin</th>
														<th class="min-w-120px">Kode Mesin</th>
														<th class="min-w-120px">Tanggal Pembelian</th>
														<th class="min-w-120px">Kategori</th>
													</tr>
												</thead>
												<!--end::Table head-->
												<tbody>


                                                    @foreach($seminggu as $m)
                                                    <tr>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $m->nama_mesin }}</span>
														</td>

														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $m->kode_mesin }}</span>
														</td>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $m->tanggal_pembelian }}</span>
														</td>

														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $m->kategori->nama_kategori }}</span>
														</td>

													</tr>

                                                @endforeach



												</tbody>
												<!--end::Table body-->
											</table>
											<!--end::Table-->
										</div>
										<!--end::Table container-->
									</div>
									<!--begin::Body-->
								<!--end::Tables Widget 13-->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_4">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">User</h1>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                								<!--begin::Tables Widget 13-->

									<!--begin::Body-->
									<div class="card-body py-3">
										<!--begin::Table container-->
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
												<!--begin::Table head-->
												<thead>
													<tr class="fw-bolder text-muted">
														<th class="min-w-140px">Nama</th>
														<th class="min-w-120px">Username</th>
														<th class="min-w-120px">Level/Role</th>
														<th class="min-w-120px">Terakhir Login</th>
													</tr>
												</thead>
												<!--end::Table head-->
												<!--begin::Table body-->
												<tbody>


                                                    @foreach($sebulan as $b)
                                                    <tr>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $b->nama }}</span>
														</td>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $b->username }}</span>
														</td>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $b->level }}</span>
														</td>
														<td>
															<span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $b->last_login }}</span>
														</td>
													</tr>

                                                @endforeach



												</tbody>
												<!--end::Table body-->
											</table>
											<!--end::Table-->
										</div>
										<!--end::Table container-->
									</div>
									<!--begin::Body-->
								<!--end::Tables Widget 13-->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

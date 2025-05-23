@extends('layouts.dashboard')

@section('title', 'Add Child Immunization Record')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Child Immunization Record</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('immunization.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Personal Information</h5>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="house_lot_no" class="form-label">House/Lot No.</label>
                            <input type="text" class="form-control @error('house_lot_no') is-invalid @enderror" id="house_lot_no" name="house_lot_no" value="{{ old('house_lot_no') }}" required>
                            @error('house_lot_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="purok" class="form-label">Purok</label>
                            <input type="text" class="form-control @error('purok') is-invalid @enderror" id="purok" name="purok" value="{{ old('purok') }}" required>
                            @error('purok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control @error('barangay') is-invalid @enderror" id="barangay" name="barangay" value="{{ old('barangay') }}" required>
                            @error('barangay')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Child's Information -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name (Optional)</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                            @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="birthplace" class="form-label">Birthplace</label>
                            <input type="text" class="form-control @error('birthplace') is-invalid @enderror" id="birthplace" name="birthplace" value="{{ old('birthplace') }}" required>
                            @error('birthplace')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                <option value="">Select Sex</option>
                                <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mothers_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control @error('mothers_name') is-invalid @enderror" id="mothers_name" name="mothers_name" value="{{ old('mothers_name') }}" required>
                            @error('mothers_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fathers_name" class="form-label">Father's Name</label>
                            <input type="text" class="form-control @error('fathers_name') is-invalid @enderror" id="fathers_name" name="fathers_name" value="{{ old('fathers_name') }}" required>
                            @error('fathers_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="birth_weight" class="form-label">Birth Weight (kg)</label>
                            <input type="number" step="0.01" class="form-control @error('birth_weight') is-invalid @enderror" id="birth_weight" name="birth_weight" value="{{ old('birth_weight') }}" required>
                            @error('birth_weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="birth_height" class="form-label">Birth Height (cm)</label>
                            <input type="number" step="0.01" class="form-control @error('birth_height') is-invalid @enderror" id="birth_height" name="birth_height" value="{{ old('birth_height') }}" required>
                            @error('birth_height')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Vaccination Information</h5>
                        <p class="small text-muted">Vaccination records can be updated later. Age calculations are done automatically based on birthdate.</p>
                    </div>
                </div>

                <!-- Vaccination Information -->
                <div class="accordion" id="vaccinationAccordion">
                    <!-- BCG Vaccine - 1 dose -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="bcgHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bcgCollapse" aria-expanded="false" aria-controls="bcgCollapse">
                                BCG (1 dose)
                            </button>
                        </h2>
                        <div id="bcgCollapse" class="accordion-collapse collapse" aria-labelledby="bcgHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bcg_date" class="form-label">Date Vaccinated</label>
                                            <input type="date" class="form-control" id="bcg_date" name="vaccines[BCG][1][date]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bcg_status" class="form-label">Status</label>
                                            <select class="form-select" id="bcg_status" name="vaccines[BCG][1][status]">
                                                <option value="Not Completed">Not Completed</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bcg_remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="bcg_remarks" name="vaccines[BCG][1][remarks]" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hepatitis B - 1 dose -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="hepbHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#hepbCollapse" aria-expanded="false" aria-controls="hepbCollapse">
                                Hepatitis B (1 dose)
                            </button>
                        </h2>
                        <div id="hepbCollapse" class="accordion-collapse collapse" aria-labelledby="hepbHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hepb_date" class="form-label">Date Vaccinated</label>
                                            <input type="date" class="form-control" id="hepb_date" name="vaccines[Hepatitis B][1][date]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hepb_status" class="form-label">Status</label>
                                            <select class="form-select" id="hepb_status" name="vaccines[Hepatitis B][1][status]">
                                                <option value="Not Completed">Not Completed</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="hepb_remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="hepb_remarks" name="vaccines[Hepatitis B][1][remarks]" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pentavalent Vaccine - 3 doses -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="pentaHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pentaCollapse" aria-expanded="false" aria-controls="pentaCollapse">
                                Pentavalent Vaccine (3 doses)
                            </button>
                        </h2>
                        <div id="pentaCollapse" class="accordion-collapse collapse" aria-labelledby="pentaHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <h6>1st Dose (1.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_date_1" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="penta_date_1" name="vaccines[Pentavalent Vaccine][1][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_status_1" class="form-label">Status</label>
                                                <select class="form-select" id="penta_status_1" name="vaccines[Pentavalent Vaccine][1][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penta_remarks_1" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="penta_remarks_1" name="vaccines[Pentavalent Vaccine][1][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>2nd Dose (2.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_date_2" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="penta_date_2" name="vaccines[Pentavalent Vaccine][2][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_status_2" class="form-label">Status</label>
                                                <select class="form-select" id="penta_status_2" name="vaccines[Pentavalent Vaccine][2][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penta_remarks_2" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="penta_remarks_2" name="vaccines[Pentavalent Vaccine][2][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>3rd Dose (3.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_date_3" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="penta_date_3" name="vaccines[Pentavalent Vaccine][3][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="penta_status_3" class="form-label">Status</label>
                                                <select class="form-select" id="penta_status_3" name="vaccines[Pentavalent Vaccine][3][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penta_remarks_3" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="penta_remarks_3" name="vaccines[Pentavalent Vaccine][3][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Oral Polio Vaccine - 3 doses -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="opvHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#opvCollapse" aria-expanded="false" aria-controls="opvCollapse">
                                Oral Polio Vaccine (3 doses)
                            </button>
                        </h2>
                        <div id="opvCollapse" class="accordion-collapse collapse" aria-labelledby="opvHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <h6>1st Dose (1.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_date_1" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="opv_date_1" name="vaccines[Oral Polio Vaccine][1][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_status_1" class="form-label">Status</label>
                                                <select class="form-select" id="opv_status_1" name="vaccines[Oral Polio Vaccine][1][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="opv_remarks_1" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="opv_remarks_1" name="vaccines[Oral Polio Vaccine][1][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>2nd Dose (2.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_date_2" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="opv_date_2" name="vaccines[Oral Polio Vaccine][2][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_status_2" class="form-label">Status</label>
                                                <select class="form-select" id="opv_status_2" name="vaccines[Oral Polio Vaccine][2][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="opv_remarks_2" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="opv_remarks_2" name="vaccines[Oral Polio Vaccine][2][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>3rd Dose (3.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_date_3" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="opv_date_3" name="vaccines[Oral Polio Vaccine][3][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="opv_status_3" class="form-label">Status</label>
                                                <select class="form-select" id="opv_status_3" name="vaccines[Oral Polio Vaccine][3][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="opv_remarks_3" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="opv_remarks_3" name="vaccines[Oral Polio Vaccine][3][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inactivated Polio Vaccine - 2 doses -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="ipvHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ipvCollapse" aria-expanded="false" aria-controls="ipvCollapse">
                                Inactivated Polio Vaccine (2 doses)
                            </button>
                        </h2>
                        <div id="ipvCollapse" class="accordion-collapse collapse" aria-labelledby="ipvHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <h6>1st Dose (3.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ipv_date_1" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="ipv_date_1" name="vaccines[Inactivated Polio Vaccine][1][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ipv_status_1" class="form-label">Status</label>
                                                <select class="form-select" id="ipv_status_1" name="vaccines[Inactivated Polio Vaccine][1][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ipv_remarks_1" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="ipv_remarks_1" name="vaccines[Inactivated Polio Vaccine][1][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>2nd Dose (3.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ipv_date_2" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="ipv_date_2" name="vaccines[Inactivated Polio Vaccine][2][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ipv_status_2" class="form-label">Status</label>
                                                <select class="form-select" id="ipv_status_2" name="vaccines[Inactivated Polio Vaccine][2][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ipv_remarks_2" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="ipv_remarks_2" name="vaccines[Inactivated Polio Vaccine][2][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pneumococcal Conjugate Vaccine - 3 doses -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="pcvHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pcvCollapse" aria-expanded="false" aria-controls="pcvCollapse">
                                Pneumococcal Conjugate Vaccine (3 doses)
                            </button>
                        </h2>
                        <div id="pcvCollapse" class="accordion-collapse collapse" aria-labelledby="pcvHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <h6>1st Dose (1.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_date_1" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="pcv_date_1" name="vaccines[Pneumococcal Conjugate Vaccine][1][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_status_1" class="form-label">Status</label>
                                                <select class="form-select" id="pcv_status_1" name="vaccines[Pneumococcal Conjugate Vaccine][1][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pcv_remarks_1" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="pcv_remarks_1" name="vaccines[Pneumococcal Conjugate Vaccine][1][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>2nd Dose (2.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_date_2" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="pcv_date_2" name="vaccines[Pneumococcal Conjugate Vaccine][2][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_status_2" class="form-label">Status</label>
                                                <select class="form-select" id="pcv_status_2" name="vaccines[Pneumococcal Conjugate Vaccine][2][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pcv_remarks_2" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="pcv_remarks_2" name="vaccines[Pneumococcal Conjugate Vaccine][2][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>3rd Dose (3.5 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_date_3" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="pcv_date_3" name="vaccines[Pneumococcal Conjugate Vaccine][3][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pcv_status_3" class="form-label">Status</label>
                                                <select class="form-select" id="pcv_status_3" name="vaccines[Pneumococcal Conjugate Vaccine][3][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pcv_remarks_3" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="pcv_remarks_3" name="vaccines[Pneumococcal Conjugate Vaccine][3][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Measles, Mumps & Rubella - 2 doses -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="mmrHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mmrCollapse" aria-expanded="false" aria-controls="mmrCollapse">
                                Measles, Mumps & Rubella (2 doses)
                            </button>
                        </h2>
                        <div id="mmrCollapse" class="accordion-collapse collapse" aria-labelledby="mmrHeading" data-bs-parent="#vaccinationAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <h6>1st Dose (9 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="mmr_date_1" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="mmr_date_1" name="vaccines[Measles,Mumps,&Rubella][1][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="mmr_status_1" class="form-label">Status</label>
                                                <select class="form-select" id="mmr_status_1" name="vaccines[Measles,Mumps,&Rubella][1][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mmr_remarks_1" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="mmr_remarks_1" name="vaccines[Measles,Mumps,&Rubella][1][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h6>2nd Dose (12 months)</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="mmr_date_2" class="form-label">Date Vaccinated</label>
                                                <input type="date" class="form-control" id="mmr_date_2" name="vaccines[Measles,Mumps,&Rubella][2][date]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="mmr_status_2" class="form-label">Status</label>
                                                <select class="form-select" id="mmr_status_2" name="vaccines[Measles,Mumps,&Rubella][2][status]">
                                                    <option value="Not Completed">Not Completed</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mmr_remarks_2" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="mmr_remarks_2" name="vaccines[Measles,Mumps,&Rubella][2][remarks]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vaccination sections will be managed in the controller automatically -->
                
                <div class="mb-3 mt-4">
                    <button type="submit" class="btn btn-primary">Save Record</button>
                    <a href="{{ route('immunization.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Automatically update the age display when birthdate changes
document.addEventListener('DOMContentLoaded', function() {
    const birthdateInput = document.getElementById('birthdate');
    
    function updateAgeDisplay() {
        const birthdate = new Date(birthdateInput.value);
        if (isNaN(birthdate.getTime())) return;
        
        const today = new Date();
        let years = today.getFullYear() - birthdate.getFullYear();
        let months = today.getMonth() - birthdate.getMonth();
        let days = today.getDate() - birthdate.getDate();
        
        if (days < 0) {
            months--;
            const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
            days += lastMonth.getDate();
        }
        
        if (months < 0) {
            years--;
            months += 12;
        }
        
        // Display age calculation result
        // This is just for display purposes - actual calculations happen in the model
    }
    
    if (birthdateInput) {
        birthdateInput.addEventListener('change', updateAgeDisplay);
        updateAgeDisplay(); // Run on page load
    }
});
</script>
@endsection 
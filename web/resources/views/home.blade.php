@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Total Records Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Records</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRecords }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Family Planning Records Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Family Planning Records</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $familyPlanningCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Immunization Records Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Immunization Records</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $immunizationCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-syringe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Health Workers Card -->
        @if(auth()->user()->isAdmin)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Health Workers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employeeStats['totalEmployees'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">
                                Active: {{ $employeeStats['activeEmployees'] }} ({{ $employeeStats['healthWorkerActivity'] }}%)
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Family Planning Charts -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Family Planning Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Monthly Records -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/fp_monthly.png') }}" alt="Monthly Family Planning Records" style="width:100%;">
                            </div>
                        </div>
                        <!-- FP Methods -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/fp_methods.png') }}" alt="FP Methods Used" style="width:100%;">
                            </div>
                        </div>
                        <!-- WRA vs NWRA -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/wra.png') }}" alt="WRA vs NWRA (15-49)" style="width:100%;">
                            </div>
                        </div>
                        <!-- Status of Records -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/fp_status.png') }}" alt="Status of Family Planning Records" style="width:100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Immunization Charts -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Immunization Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Monthly Records -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/imm_monthly.png') }}" alt="Monthly Immunization Records" style="width:100%;">
                            </div>
                        </div>
                        <!-- Vaccines Given -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/vaccines.png') }}" alt="Vaccines Given" style="width:100%;">
                            </div>
                        </div>
                        <!-- Records per Purok -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/purok.png') }}" alt="Child Records per Purok" style="width:100%;">
                            </div>
                        </div>
                        <!-- Vaccination Status -->
                        <div class="col-md-6 mb-4">
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <img src="{{ asset('charts/vaccination_status.png') }}" alt="Vaccination Status" style="width:100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

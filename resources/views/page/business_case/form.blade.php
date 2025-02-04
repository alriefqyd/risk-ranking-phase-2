<style>
    .field-container {
        border-bottom: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 15px;
    }

    .field-container h6 {
        margin: 0 0 8px;
        font-size: 15px;
        color: #333;
    }

    .field-container small {
        display: block;
        margin-bottom: 10px;
        font-size: 12px;
        color: #777;
    }

    label {
        font-size: 14px; /* Reduced font size for labels */
        color: #555;
    }

    .form-control {
        font-size: 14px;
    }
</style>

<div class="container js-table-cost-benefit">
    <input type="hidden" class="js-project-id" value="{{$project->id ?? ''}}">

    <!-- Problem Statement -->
    <div class="field-container">
        <h6>Problem Statement <span class="text-danger">*</span></h6>
        <small>Provide a clear and concise description of the issue or opportunity being addressed by this project.</small>
        <textarea class="tinymce js-bc_problem_statement" name="problem_statement">{!! $project->business_case?->problem_statement_and_objective_text ?? ""!!}</textarea>
        <div class="text-danger js-error-message mb-4 mt-2"></div>
    </div>

    <!-- Objective -->
    <div class="field-container">
        <h6>Objective<span class="text-danger">*</span></h6>
        <small>(Clear objective of projected connected to finding a solution of the stated problem statement above – preferably measurable objectives)</small>
        <textarea class="tinymce" name="objective">{!! $project?->business_case?->objective ?? ""!!}</textarea>
        <div class="text-danger js-error-message mb-4"></div>
    </div>

    <!-- Scope of Work -->
    <div class="field-container">
        <h6>Scope of Work <span class="text-danger">*</span></h6>
        <small>Define the specific tasks and deliverables required to address the problem or opportunity.</small>
        <textarea class="tinymce js-bc_scope_of_work" name="scope_of_work">{!! $project?->business_case?->project_scope_of_work_text ?? "" !!}</textarea>
        <div class="text-danger js-error-message mb-4"></div>
    </div>

    <!-- Financial Evaluation -->
    <div class="field-container">
        <h6>Financial Evaluation </h6>
        <small>Summarize the financial benefits of the project. Include metrics such as NPV, IRR, payback period, and TCO.</small>
        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <label>NPV ($) <span class="text-danger">*</span></label>
                <input type="text" name="npv" value="{{$project?->business_case?->npv}}" class="form-control js_bc_npv js-currency-format">
            </div>
            <div class="col-md-6 mb-2">
                <label>IRR (%) <span class="text-danger">*</span></label>
                <input type="number" name="irr" value="{{$project?->business_case?->irr}}" class="form-control js_bc_irr">
            </div>
            <div class="col-md-6 mb-2">
                <label>Payback Period (Years) <span class="text-danger">*</span></label>
                <input type="number" name="payback_period" value="{{$project?->business_case?->payback_period}}" class="form-control js_bc_payback_period">
            </div>
            <div class="col-md-6 mb-2">
                <label>TCO ($) <span class="text-danger">*</span></label>
                <input type="text" name="tco" value="{{$project?->business_case?->tco}}" class="form-control js_bc_tco js-currency-format">
            </div>
        </div>
        <div class="mb-4">
            <label for="additionalFile" class="form-label">Approved Financial Evaluation (by FA) <span class="text-danger">*</span></label>
            <input type="file" class="filepond js-attachment-financial_evaluation" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'financial_evaluation')}}" name="financial_evaluation" id="file">
            @if($project?->getAllAttachment($project->business_case?->attachment,'financial_evaluation'))
                <div class="mt-2">
                    <a
                        href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'financial_evaluation'))}}"
                        target="_blank"
                        class="text-decoration-none">
                        <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Cost Estimate -->
    <div class="field-container">
        <h6>Cost Estimate <span class="text-danger">*</span></h6>
        <small>Enter the estimated total cost of the project, including all relevant expenses.</small>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="text" value="{{$project?->business_case?->cost_estimate}}" name="cost_estimate" class="form-control js-cost_estimate_bc js-currency-format">
        </div>
        <span class="js-error"></span>
        <div class="mb-4 mt-4">
            <label for="additionalFile" class="form-label fw-bold">Cost Estimate With Rough of Magnitude 15-20% <span class="text-danger">*</span></label>
            <input type="file" class="filepond js-attachment-cost_estimate" name="cost_estimate_file" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'cost_estimate_file')}}" id="file">
            @if($project?->getAllAttachment($project->business_case?->attachment,'cost_estimate_file'))
                <div class="mt-2">
                    <a
                        href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'cost_estimate_file'))}}"
                        target="_blank"
                        class="text-decoration-none">
                        <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Risk Assessment -->
    <div class="field-container">
        <h6>Risk Assessment </h6>
        <small>Summarize the financial benefits of the project. Include metrics such as NPV, IRR, payback period, and TCO.</small>
        <div class="row mb-4">
            <div class="col-md-4 mb-2">
                <label>Risk Level Residual <span class="text-danger">*</span>:</label>
                <input type="number" value="{{$project?->business_case?->riskAssessment?->risk_level_residual ?? ""}}" name="risk_level_residual" class="form-control js-risk-level-count js-risk-residual">
            </div>
            <div class="col-md-4 mb-2">
                <label>Risk Level Forecast <span class="text-danger">*</span>:</label>
                <input type="number" value="{{$project?->business_case?->riskAssessment?->risk_level_forecast ?? ""}}" name="risk_level_forecast" class="form-control js-risk-level-count js-risk-forecast">
            </div>
            <div class="col-md-4 mb-2">
                <label>Risk Deduction <span class="text-danger">*</span>:</label>
                <input type="number" value="{{$project?->business_case?->riskAssessment?->risk_level_deduction ?? ""}}" name="risk_deduction" readonly class="form-control js-risk-deduction">
            </div>
        </div>
        <div class="mb-4">
            <label for="additionalFile" class="form-label">Approved Risk Matrix (by HSOR) <span class="text-danger">*</span></label>
            <input type="file" class="filepond js-attachment_risk_assessment" name="risk_assessment" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'risk_assessment')}}" id="file">
            @if($project?->getAllAttachment($project->business_case?->attachment,'risk_assessment'))
                <div class="mt-2">
                    <a
                        href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'risk_assessment'))}}"
                        target="_blank"
                        class="text-decoration-none">
                        <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="field-container">
        <h6>KPI Summary <span class="text-danger">*</span></h6>
        <small>(Description of project's expected benefit and measurable KPIs, a plan to measure and calculate the benefit/KPIs for post project review, and the estimated timeframe to achieve KPI/benefit from the execution of this project)</small>
        <div class="row p-4">
            <table class="table table-striped js-table-kpi">
                <thead>
                <tr>
                    <th style="width: 60%">KPI</th>
                    <th>Est Time to Benefit</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($kpiData))
                    @foreach($kpiData as $data)
                        <tr class="js-table-row-kpi" data-idx="{{$loop->index}}">
                            <td>
                                <input class="form-control js-kpi-desc" value="{{$data['description']}}" name="kpi_description[]">
                            </td>
                            <td>
                                <select name="kpi_benefit[]" class="form-control select2 js-kpi-time-benefit">
                                    <option {{$data['time_to_benefit'] == "0-1" ? 'selected' : ''}} value="0-1">0 - 1 Year</option>
                                    <option {{$data['time_to_benefit'] == "1-2" ? 'selected' : ''}} value="1-2">1 - 2 years</option>
                                    <option {{$data['time_to_benefit'] == "2-3" ? 'selected' : ''}} value="2-3">2 - 3 years</option>
                                    <option {{$data['time_to_benefit'] == "3-4" ? 'selected' : ''}} value="3-4">3 - 4 years</option>
                                    <option {{$data['time_to_benefit'] == "4-5" ? 'selected' : ''}} value="4-5">4 - 5 years</option>
                                    <option {{$data['time_to_benefit'] == "5+" ? 'selected' : ''}} value="5+">5+ years</option>
                                </select>
                            </td>
                            <td>
                            <td>
                            <span class="btn btn-sm btn-danger js-remove-kpi-fel3">
                                <i class="fa fa-trash"></i>
                            </span>
                                <span class="btn btn-sm btn-success js-add-new-kpi-fel3">
                                <i class="fa fa-plus"></i>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="js-table-row-kpi" data-idx="0">
                        <td>
                            <input class="form-control js-kpi-desc" name="kpi_description[]">
                        </td>
                        <td>
                            <select name="kpi_benefit[]" class="form-control select2 js-kpi-time-benefit">
                                <option>0 - 1 Year</option>
                                <option>1 - 2 years</option>
                                <option>2 - 3 years</option>
                                <option>3 - 4 years</option>
                                <option>4 - 5 years</option>
                                <option>5+ years</option>
                            </select>
                        </td>
                        <td>
                        <td>
                            <span class="btn btn-sm btn-danger js-remove-kpi-fel3">
                                <i class="fa fa-trash"></i>
                            </span>
                            <span class="btn btn-sm btn-success js-add-new-kpi-fel3">
                                <i class="fa fa-plus"></i>
                            </span>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

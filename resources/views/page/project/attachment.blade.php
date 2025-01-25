<div class="container mt-4">
    <!-- FEL 3 Approved Document -->
    <div class="mb-4">
        <label for="fel3File" class="form-label fw-bold">Preliminary Design <span class="text-danger">*</span></label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'preliminary_design')}}" name="preliminary_design" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']))
            <div class="mt-2">
                <a
                    href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']))}}&dir={{$project->project_name}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Document
                </a>
            </div>
        @endif
    </div>

    <!-- Change Management Request -->
    <div class="mb-4">
        <label for="changeRequestFile" class="form-label fw-bold">Hazop Study</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop'])}}" name="hazop" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop']))
            <div class="mt-2">
                <a
                    href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop']))}}&dir={{$project->project_name}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Document
                </a>
            </div>
        @endif
    </div>

    <!-- Additional Attachments -->
    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">MOC Document</label>
        <input type="file" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'moc_document')}}" class="filepond" name="moc_document" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,'moc_document'))
            <div class="mt-2">
                <a
                    href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'moc_document'))}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                </a>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">Cost Estimate With Rough of Magnitude 15-20%</label>
        <input type="file" class="filepond" name="cost_estimate_file" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'cost_estimate_file')}}" id="file">
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

    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">Quotation of Equipment / Site Query</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'quotation_of_equipment')}}" name="quotation_of_equipment" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,'quotation_of_equipment'))
            <div class="mt-2">
                <a
                    href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'quotation_of_equipment'))}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                </a>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">Relevant AMF/LCC Report</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'lcc_report')}}" name="lcc_report" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,'lcc_report'))
            <div class="mt-2">
                <a
                    href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'lcc_report'))}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                </a>
            </div>
        @endif
    </div>
    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">Financial Evaluation Approved</label>
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
    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">Risk Assessment Approved</label>
        <input type="file" class="filepond" name="risk_assessment" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'risk_assessment')}}" id="file">
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
    <div class="mb-4">
        <label for="additionalFile" class="form-label fw-bold">BC Approved</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}" name="business_case" id="file">
        @if($project?->getAllAttachment($project->business_case?->attachment,'business_case'))
            <div class="mt-2">
                <a
                    href="/preview?dir={{urlencode($project->project_name)}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{urlencode($project->getAllAttachment($project->business_case?->attachment,'business_case'))}}"
                    target="_blank"
                    class="text-decoration-none">
                    <i class="fa fa-file-text-o text-info"></i> View Existing Attachment
                </a>
            </div>
        @endif
    </div>
    <input type="hidden" name="folder" value="{{uniqid() . '-' . now()->timestamp}}" class="js-temp-folder">
</div>

<style>
    .form-label {
        font-size: 1rem;
    }
    .form-control {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        font-size: 0.95rem;
    }
    .text-muted {
        font-size: 0.85rem;
    }
    .text-decoration-none:hover {
        text-decoration: underline;
    }
</style>
@section('scripts')
<script>
    $(document).ready(function () {
        $('.filepond').each(function () {
            const inputElement = this; // Reference to the current file input element
            const documentType = $(inputElement).attr('name'); // Get the name attribute
            const tempFolder = $('.js-temp-folder').val(); // Get the temp folder value

            const fileSource = $(inputElement).attr('data-value');
            const isValidSource = fileSource && fileSource !== 'null' && fileSource !== 'undefined';

            // Initialize FilePond
            const pond = FilePond.create(inputElement);

            {{--console.log({{ csrf_token() }})--}}
            // Set FilePond options for this instance
            pond.setOptions({
                files: isValidSource
                    ? [
                        {
                            source: fileSource,
                            options: {
                                type: 'local',
                            },
                        },
                    ]
                    : [], // If invalid, set an empty array to prevent issues
                server: {
                    process: {
                        url: '/upload',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        ondata: function (formData) {
                            // Dynamically get the 'name' and other attributes from the current element
                            const currentTempFolder = $('.js-temp-folder').val(); // Adjust if the folder is form-specific
                            formData.append('type', pond.name);
                            formData.append('folder', currentTempFolder);

                            return formData;
                        },
                    },
                    revert: {
                        url: '/upload/cancel?folder=' + tempFolder + '&type=' + pond.name, // API endpoint to handle cancellation
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        ondata: function (formData, file) {
                            // Dynamically get the 'name' and other attributes from the current element
                            const currentTempFolder = $('.js-temp-folder').val(); // Adjust if the folder is form-specific
                            console.log(currentTempFolder)
                            return formData;
                        },
                    },
                },
            });

            pond.on('removefile', (error, file) => {
                if (!error) {
                    console.log(`File ${file.filename} was removed.`);
                    // You could trigger additional cleanup logic here if needed.
                }
            });

        });
    });

</script>
@endsection

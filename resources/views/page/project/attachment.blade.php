<div class="container mt-4 js-tour" data-tg-tour="Attach all required supporting documents before submission.">
    <!-- FEL 3 Approved Document -->
    <div class="mb-4 js-parent-pd">
        <label for="fel3File" class="form-label fw-bold">Preliminary Design <span class="text-danger">*</span></label>
        <input type="file" class="filepond js-attachment-preliminary_design"
               name="preliminary_design[]" multiple id="preliminary_design"
               data-value="{{json_encode($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']))}}"
                >
        <div class="mt-2">
            @if($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']))
                <ul>
                    @foreach($project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['preliminary_design']) as $pd)
                        <li class="js-existing-pd"><a
                            href="/preview?id={{$project->id}}&category={{$setting::FOLDER_TYPE['bc']}}&file={{$pd}}&dir={{$project->project_name}}"
                            target="_blank"
                            class="text-decoration-none">
                            <i class="fa fa-file-text-o text-info"></i> View Existing Document {{$pd}}
                        </a></li>
                    @endforeach
                </ul>
            @endif
            <span class="text-danger">* Submit only fully completed and approved documents.</span>
        </div>
    </div>
    <!-- Change Management Request -->
    <div class="mb-4">
        <label for="changeRequestFile" class="form-label fw-bold">Hazop Study</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,$setting::BUSINESS_CASE_ATTACHMENT['hazop'])}}" name="hazop" id="hazop">
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
        <input type="file" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'moc_document')}}" class="filepond" name="moc_document" id="moc_document">
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
        <label for="additionalFile" class="form-label fw-bold">Quotation of Equipment / Site Query</label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'quotation_of_equipment')}}" name="quotation_of_equipment" id="quotation">
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
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'lcc_report')}}" name="lcc_report" id="lcc">
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
        <label for="additionalFile" class="form-label fw-bold">Approved BC Form <span class="text-danger">*</span></label>
        <input type="file" class="filepond" data-value="{{$project?->getAllAttachment($project->business_case?->attachment,'business_case')}}" name="business_case" id="bc">
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
        <p><span class="text-danger">* Submit only fully completed and approved documents.</span></p>
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
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
    </script>
    <script>
        $(document).ready(function () {
            $('.filepond').each(function () {
                const inputElement = this; // Reference to the current file input element
                const documentType = $(inputElement).attr('name'); // Get the name attribute
                const tempFolder = $('.js-temp-folder').val(); // Get the temp folder value

                var fileSource = $(inputElement).attr('data-value');
                const isValidSource = fileSource && fileSource !== 'null' && fileSource !== 'undefined';
                var f =  [{
                        source: fileSource,
                        options: {
                            type: 'local',
                        },
                    }]
                if(documentType == 'preliminary_design[]'){
                    fileSource = JSON.parse(fileSource)
                    if(fileSource == null){
                        fileSource = [{
                            source: fileSource,
                            options: {
                                type: 'local',
                            },
                        }]
                    }
                    f = fileSource.map(fi => ({
                        source: fi,
                        options: {
                        type: 'local',
                        },
                    }));
                }
                // Initialize FilePond
                const pond = FilePond.create(inputElement);
                // Set FilePond options for this instance
                pond.setOptions({
                    files: isValidSource
                        ? f
                        : [], // If invalid, set an empty array to prevent issues
                    server: {
                        process: {
                            url: '/upload',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            ondata: function (formData) {
                                console.log(pond.element.id)
                                // Dynamically get the 'name' and other attributes from the current element
                                const currentTempFolder = $('.js-temp-folder').val(); // Adjust if the folder is form-specific
                                formData.append('folder', currentTempFolder);
                                // formData.append('field_name')
                                // Check if the field supports multiple files
                                if (pond.element.hasAttribute('multiple')) {
                                    formData.append('type', pond.name + '[]');
                                } else {
                                    formData.append('type', pond.name);
                                }

                            return formData;
                        },
                    },
                    revert: {
                        url: '/upload/cancel?folder=' + tempFolder + '&type=' + pond.element.id, // API endpoint to handle cancellation
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                    },
                },
                // Restrict file types to PDF only
                acceptedFileTypes: ['application/pdf'], // Only allow PDFs
                labelFileTypeNotAllowed: 'Only PDF files are allowed.', // Custom error message
                fileValidateTypeLabelExpectedTypes: 'Expected a PDF file', // Tooltip for validation
                labelMaxFileSizeExceeded:'The maximum size of file is 20MB',
                maxFileSize: 2.5 * 1024 * 1024
            });

            pond.on('removefile', (error, file) => {
                if (!error) {
                    console.log(`File ${file.filename} was removed.`);
                    if(pond.element.id == "preliminary_design"){
                        const tempFolder = $('.js-temp-folder').val(); // Get the temp folder value
                        $.ajax({
                            url: '/upload/cancel?folder=' + tempFolder + '&type=' + pond.element.id + '&file_name=' + file.filename,
                            type: 'DELETE',
                            success: function (response) {
                                console.log(response)
                            }
                        })

                    }
                    // You could trigger additional cleanup logic here if needed.
                }
            });

            });
        });
    </script>
@endsection

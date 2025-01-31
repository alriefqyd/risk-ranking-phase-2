<div class="revision-log-container">
    <table class="revision-table">
        <thead>
        <tr>
            <th>Revision No.</th>
            <th>Revision Date</th>
            <th>Summary of Changes</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            @if(!empty(json_decode($log['changes'])))
                <tr>
                    <td>{{$log['revision']}}</td>
                    <td>{{$log['date']}}</td>
                    <td>
                        <ul style="list-style-type: disc; margin-left: 20px;">
                            @foreach(json_decode($log['changes']) as $item)
                                @if($item->field == 'preliminary_design')
                                    <li>Adjusted the file preliminary design</li>
                                @else
                                    @if(isset($item->oldValue))
                                        <li>Adjusted the {{$item->field}} from {{$item->oldValue}} to {{$item->newValue}}.</li>
                                    @else
                                        <li>Added a new file/value for {{$item->field}} : {{$item->newValue}}</li>
                                    @endif
                                @endif

                            @endforeach
                        </ul>
                    </td>
                </tr>
            @elseif($log['revision'] == 1)
                <tr>
                    <td>{{$log['revision']}}</td>
                    <td>{{$log['date']}}</td>
                    <td>
                        <ul style="list-style-type: disc; margin-left: 20px;">
                            Business Case {{$project->title}} Created and Publish
                        </ul>
                    </td>
                </tr>
            @endif
        @endforeach

        <!-- More entries here -->
        </tbody>
    </table>
</div>

<style>
    h1 {
        font-size: 24px;
        color: #333;
    }

    .revision-table {
        width: 100%;
        border-collapse: collapse;
    }

    .revision-table th, .revision-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .revision-table th {
        background-color: #f4f4f4;
    }

    .revision-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .add-revision-btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .add-revision-btn:hover {
        background-color: #0056b3;
    }

</style>

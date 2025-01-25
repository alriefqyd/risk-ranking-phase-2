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
                <tr>
                    <td>{{$log['revision']}}</td>
                    <td>{{$log['date']}}</td>
                    <td>
                        <ul style="list-style-type: disc; margin-left: 20px;">
                            {{--                        {{dd(json_decode($log['summary_of_changes']))}}--}}
                            @if($loop->index > 0)
                                @foreach(json_decode($log['summary_of_changes']) as $item)
                                    @if($item->oldValue != $item->newValue)
                                        <li>Adjusted the {{$item->field}} from {{$item->oldValue}} to {{$item->newValue}}.</li>
                                    @endif
                                @endforeach
                            @else
                                Business Case {{$project->title}} Created and Publish
                            @endif
                        </ul>
                    </td>
                </tr>
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

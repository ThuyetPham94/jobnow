    @foreach($user as $key=>$item)
    <tr id="tr{{ $item->user_id }}">
        <td>{{ $key+1 }}</td>
        <td style='text-align: center;width: 8%;'>
            @if(@getimagesize($item->Avatar))
            <img src="{{ $item->Avatar }}" style='width:65px' />
            @elseif($item->Avatar ==null )
            <img src='{{asset('uploads/images/seeker/'.$item->Avatar)}}' style='width:65px'  />
            @else
            <img src='{{asset('upload/images/seeker/btn_locate_profile_not_active.png')}}' style='width:65px'  />
            @endif
        </td>
        <td>{{ $item->FullName }}</td>
        <td>{{ $item->Name }}</td>
        <td>{{ $item->Title }}</td>
        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
        <td style='width: 22%' id='addShort{{ $item->user_id }}'>
            @if($item->exist == 'true')
            <div class='header-main5' style='padding:0'><a class='btn pull-left' style='margin-left: 20px;'>Đã thêm</a></div>
            @else
            <div class='header-main4'>
                <a href='javascript:void(0)' onclick='addShort({{ $item->user_id}},{{$item->JobID}})' class='btn pull-left' style='margin-left: 20px;'>Thêm vào danh sách</a>
            </div>
            @endif
        </td>
    </tr>
    @endforeach
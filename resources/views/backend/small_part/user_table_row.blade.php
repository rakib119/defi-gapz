@forelse ($users as $user)
    @php
        $status = $user->identification_status;
        $balance =  $user->balance;
        $role = $user->role;
        $original_balance = (float) original_balance($user->uid) - (float) $balance;
        $status = false;
        if ($original_balance < 0) {
            $status = true;
        }
    @endphp
    <tr class="text-center">
        <td>{{ $loop->index + 1 }}</td>
        <td><a href="{{ route('user_details', $user->id) }}"> {{ $user->name }} </a></td>
        <td>{{ $user->uid }}</td>
        <td><span class="badge {{ $role == 0 ? 'bg-primary' : ($role == 2 ? 'bg-secondary' : 'bg-success') }}">
                {{ $role == 0 ? 'User' : ($role == 2 ? 'Merchant' : 'Admin') }}</span> </td>
        <td>{{ $balance }}</td>
        <td><span class="badge {{ $status ? 'bg-danger' : 'bg-success' }}">{{ $status ? 'Need To Check' : 'Look Great' }}
            </span></td>
        <td>{{ $user->country }}</td>
        <td>
            <div class="btn-group text-center">
                <button type="button" class="btn btn-primary has-arrow dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Action <i class="fas fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu ">
                    <li>
                        <a class="dropdown-item" href="{{ route('user_details', $user->id) }}"><i
                                class=" fa  fa-info"></i>&nbsp;&nbsp;&nbsp;Details</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class=" fa  fa-ban"></i>&nbsp;&nbsp;
                                Suspend</button>
                        </form>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('user_delete_permanently', $user->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;&nbsp;
                                Delete</button>
                        </form>
                    </li>
                </ul>
        </td>
    </tr>
@empty
    <tr class="text-center">
        <td class="no-data" colspan="8">Data Not Found!</td>
    </tr>
@endforelse

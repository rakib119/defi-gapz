@foreach ($users as $user)
    @php
        $status = $user->identification_status;
        if ($user->account_statement) {
            $balance = $user->account_statement->balance;
        } else {
            $balance = 0;
        }
        $role = $user->role;
        $original_balance = (float) original_balance($user->uid) - (float) $balance;
        $status = false;
        if ($original_balance < -1) {
            $status = true;
        }
    @endphp
    <tr class="text-center">
        <td>{{ ++$i }}</td>
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
                    @if ($user->in_transaction->isEmpty() && $user->account_transaction->isEmpty())
                        <li>
                            <form method="POST" action="{{ route('user_delete_permanently', $user->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;&nbsp;
                                    Delete</button>
                            </form>
                        </li>
                    @endif
                </ul>
        </td>
    </tr>
@endforeach

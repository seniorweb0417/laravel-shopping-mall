@extends('admin.layouts.app')

@section('content')

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">User ( {{ $user->name }} )</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Users</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }} ({{ $user->username }})</td>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $user->mobile }}</td>
                    <th>Status</th>
                    <td>{{ $user->status() }}</td>
                </tr>
                <tr>
                    <th>Created date</th>
                    <td>{{ $user->created_at->format('d-m-Y h:i a') }}</td>
                    <th>Orders Count</th>
                    <td>{{ $user->orders_count }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">Orders</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order number</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Price</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($user->orders as $order)
                    <tr>
                        <td>{{$order->order_number}}</td>
                        <td>
                            @forelse($order->items as $product)
                                <p>{{ $product->name }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td>
                            @foreach($order->OrderItems as $item)
                                <p>x{{ $item->quantity }}</p>
                            @endforeach
                        </td>
                        <td>
                            @forelse($order->OrderItems as $item)
                                <p>${{ $item->price }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td>
                            @if($order->status)
                                <span class="badge badge-success">Confirmed</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="5">No orders found.</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">Reviews</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-content table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>comment</th>
                    <th>Status</th>
                    <th>Create at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($user->comments as $comment)
                    <tr>
                        <td><img src="{{ get_gravatar($comment->email, 50) }}" alt="" class="img-circle"></td>
                        <td>{{ $comment->name }}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-toggle">
                                <a href="{{ route('admin.product-comments.edit', $comment->id) }}" title="Edit" class="btn-primary btn btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                    { document.getElementById('comment-delete-{{ $comment->id }}').submit(); } else { return false; }"
                                   title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form action="{{ route('admin.product-comments.destroy', $comment->id) }}" method="post" id="comment-delete-{{ $comment->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="9" class="text-center">No comments found.</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection























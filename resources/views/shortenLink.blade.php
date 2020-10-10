<!DOCTYPE html>
<html>

<head>
    <title>Test CaptainW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
</head>

<body>

    <div class="container">
        <h1>URL Shortner</h1>

        <div class="card">
            <div class="card-header">
                <form method="POST" action="{{ route('store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" name="add">
                        <input type="text" name="link" class="form-control" placeholder="Enter URL (http:// or https://)" aria-label="Recipient's username" >
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Generate Shorten Link</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">

                @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Short Link</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ $row->code}}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>
                                <form method="POST" action="{{  route('delete')}}">
                                    @csrf
                                    <input type="hidden" name="delete">
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                    <button class="btn btn-success" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
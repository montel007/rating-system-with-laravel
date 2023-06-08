{{-- @section('header')
@extends('/layouts.app')
@endsection


@section('content') --}}


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <title>Rating System</title>
</head>
<body>

        <div class="container">
            <h1>Products</h1>
            <a href="{{route('reports.generate')}}" class="btn btn-primary">Generate report</a>

            <div class="mt-3">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="keywords">Keywords:</label>
                            <input type="text" name="keywords" id="keywords" value="{{ request('keywords') }}" class="form-control" placeholder="Enter keywords">
                        </div>
                        <div class="col-md-4">
                            <label for="rating">Rating:</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="">All Ratings</option>
                                <option value="1" {{ request('rating') === '1' ? 'selected' : '' }}>1 Star</option>
                                <option value="2" {{ request('rating') === '2' ? 'selected' : '' }}>2 Stars</option>
                                <option value="3" {{ request('rating') === '3' ? 'selected' : '' }}>3 Stars</option>
                                <option value="4" {{ request('rating') === '4' ? 'selected' : '' }}>4 Stars</option>
                                <option value="5" {{ request('rating') === '5' ? 'selected' : '' }}>5 Stars</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sort">Sort by:</label>
                            <select name="sort" id="sort" class="form-control">
                                <option value="default" {{ request('sort') === 'default' ? 'selected' : '' }}>Default</option>
                                <option value="highest-ratings" {{ request('sort') === 'highest-ratings' ? 'selected' : '' }}>Highest Ratings</option>
                                <option value="lowest-ratings" {{ request('sort') === 'lowest-ratings' ? 'selected' : '' }}>Lowest Ratings</option>
                                <option value="date" {{ request('sort') === 'date' ? 'selected' : '' }}>Date</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Vendor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                {{ $product->name }}

                                <!-- Loop through each rating for the product -->
                                @foreach ($product->ratings as $rating)
                                    <div class="container">
                                        <div class="row">
                                            <div class="col mt-4">
                                                <p class="font-weight-bold">Review</p>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <div class="rated">
                                                            <!-- Display the rating value -->
                                                            @for ($i = 1; $i <= $rating->rating; $i++)
                                                                <label class="star-rating-complete" title="text">{{ $i }} stars</label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-4">
                                                    <div class="col">
                                                        <!-- Display the comment -->
                                                        <p>{{ $rating->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($product->ratings->isEmpty())
                                    <!-- Display the rating creation form -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col mt-4">
                                                <form class="py-2 px-4" action="{{ route('ratings.store') }}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                                                    @csrf
                                                    <p class="font-weight-bold">Review</p>
                                                    <div class="form-group row">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <div class="col">
                                                            <div class="rate">
                                                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" checked id="star4" class="rate" name="rating" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" class="rate" name="rating" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-4">
                                                        <div class="col">
                                                            <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 text-right">
                                                        <button class="btn btn-sm py-2 px-3 btn-info">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $product->vendor->name }}</td>
                            <td>
                                <!-- Actions -->
                            </td>
                        </tr>
                    @endforeach

                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="3">No products listing at the moment</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>




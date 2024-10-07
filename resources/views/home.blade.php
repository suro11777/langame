@extends('layouts.app')

@section('content')
    @if(auth()->user()->is_confirmed)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form id="search-form" class="mb-4">
                                <div class="input-group">
                                    <input type="text" id="search-input" name="search_text" class="form-control"
                                           placeholder="Search news...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Articles Table -->
                            <div id="news-table">
                                @include('partials.articles-table', ['articles' => $articles])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search-form').on('submit', function(event) {
                event.preventDefault();
                var searchQuery = $('#search-input').val();

                $.ajax({
                    url: "{{ route('home') }}",
                    method: 'GET',
                    data: { search_text: searchQuery },
                    success: function(response) {
                        $('#news-table').html(response);
                    }
                });
            });
        });



    </script>
@endpush

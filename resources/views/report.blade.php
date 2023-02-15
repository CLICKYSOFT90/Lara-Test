<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    </head>
    <body class="antialiased">
        <div class="container-fluid mt-5">
            <form method="post" action="{{ route("get-report") }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Select campaigns</b>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="checkUncheckAll">
                                        Select/Deselect All
                                    </label>
                                </div>
                                <hr />
                                @foreach($campaigns as $campaign)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input chk-campain" type="checkbox" name="campaigns[]" value="{{ $campaign->campaign }}"{{ in_array($campaign->campaign, $select_campaigns) ? " checked" : ""}}>
                                            {{ $campaign->campaign }}
                                        </label>
                                    </div>
                                @endforeach
                                @if($errors->has('campaigns'))
                                    <div style="font-size: .875em;color: #dc3545;">
                                        {{ $errors->first('campaigns') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dateFrom">Date From:</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control date-picker {{ $errors->has('date_from') ? 'is-invalid' : '' }}" name="date_from" id="dateFrom" value="{{ $date_from }}" autocomplete="off" />
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                        @if($errors->has('date_from'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('date_from') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dateTo">Date To:</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control date-picker {{ $errors->has('date_to') ? 'is-invalid' : '' }}" name="date_to" id="dateTo" value="{{ $date_to }}" autocomplete="off" />
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                        @if($errors->has('date_to'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('date_to') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Get Report</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if(count($googleAds) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Campaign</th>
                                        <th>Cost</th>
                                        <th>Cost/day</th>
                                        <th>Impressions</th>
                                        <th>Clicks</th>
                                        <th>Conversions</th>
                                        <th>CPC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($googleAds as $googleAd)
                                    <tr>
                                        <td>{{ $googleAd->campaign_state }}</td>
                                        <td>{{ $googleAd->campaign }}</td>
                                        <td>{{ $googleAd->cost }}</td>
                                        <td>{{ $googleAd->cost_per_day }}</td>
                                        <td>{{ $googleAd->impressions }}</td>
                                        <td>{{ $googleAd->clicks }}</td>
                                        <td>{{ $googleAd->conversions }}</td>
                                        <td>{{ $googleAd->cost_per_day }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @elseif(request()->isMethod('post'))
                            <div class="alert alert-warning" role="alert">
                                Sorry, no result found.
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'></script>
    <script id="rendered-js" >
        $(function () {
          $('.date-picker').datepicker({
            format: "yyyy-m-d",
          });
          $("#checkUncheckAll").on("change", function () {
            $(".chk-campain").attr("checked", $(this).is(":checked"))
          })
        });
    </script>
</html>

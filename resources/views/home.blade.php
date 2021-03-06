@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <h1 >Welcome, {{ $user->getFirstName() }}</h1>
      <hr>
    </div>
  </div>
  <div class="card-columns">
    @component('card.status', ['user' => $user, 'memberStatus' => $memberStatus, 'votingStatus' => $votingStatus])
    @endcomponent
    @component('card.proxy')
    @endcomponent
    @component('card.projects', ['user' => $user, 'projects' => $projects])
    @endcomponent
    @component('card.teams', ['user' => $user, 'teams' => $teams])
    @endcomponent
    @component('card.snackspace', ['user' => $user, 'snackspaceTransactions' => $snackspaceTransactions])
    @endcomponent
    @component('card.tools', ['user' => $user, 'bookings' => $bookings, 'toolIds' => $toolIds])
    @endcomponent
    @component('card.boxes', ['user' => $user, 'boxCount' => $boxCount])
    @endcomponent
    @component('card.commonTasks', ['user' => $user])
    @endcomponent
    @component('card.access', ['user' => $user])
    @endcomponent
    <donation-stripe-payment></donation-stripe-payment>
  </div>
</div>
@endsection

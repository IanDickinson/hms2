@extends('layouts.app')

@section('pageTitle', 'Links')

@section('content')
<div class="container">
  <h2>Useful links for Members</h2>
  <hr>

  @can('link.create')
  <a href="{{ route('links.create') }}" class="btn btn-primary btn-block"><i class="fas fa-plus" aria-hidden="true"></i> Add new link</a>
  <br>
  @endcan

  <div class="card-columns">
    @foreach ($links as $link)
    <div class="card text-center">
      <div class="card-header text-center">
          <a href="{{ $link->getLink() }}" target="_blank">
            <h3>{{ $link->getName() }}</h3>
          </a>
      </div>
      @if ($link->getDescription())
      <div class="card-body">
        <p class="card-text text-center lead">{{ $link->getDescription() }}</p>
      </div>
      @endif
      @can('link.edit')
      <div class="card-footer">
        <a href="{{ route('links.edit', $link->getId()) }}" class="btn btn-primary"><i class="fas fa-pencil" aria-hidden="true"></i> Edit</a>
        <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn btn-danger">
          <form action="{{ route('links.destroy', $link->getId()) }}" method="POST" style="display: none">
            @method('DELETE')
            @csrf
          </form>
          <i class="fas fa-trash" aria-hidden="true"></i> Remove
        </a>
      </div>
      @endcan
    </div>
    @endforeach
  </div>

  <div classs="pagination-links">
    {{ $links->links() }}
  </div>
</div>
@endsection

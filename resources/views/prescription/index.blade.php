@extends('layouts.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Prescription</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Prescription</li>
        <li class="breadcrumb-item active">Index</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">
            <a href="{{ route('prescription.create') }}" class="btn btn-primary">Add Data</a>
          </div>
          <div class="card-body">
            <div class="card-title">
              <h5>Prescription Index</h5>
            </div>
            <p>Information about all prescription data</p>

            <!-- Table with stripped rows -->
            <table class="table datatable small">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Code</th>
                  <th scope="col">Created By</th>
                  <th scope="col">Created At</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                @foreach($prescriptions as $key => $prescription)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $prescription->code }}</td>
                  <td>{{ $prescription->user->name }}</td>
                  <td>{{ $prescription->created_at->format('d/m/Y') }}</td>
                  <td>
                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-file-pdf"></i></a>
                    <a href="{{ route('prescription.show', $prescription->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            $prescriptions->links()
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

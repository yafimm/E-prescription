@extends('layouts.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Prescription</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('prescription.index') }}">Prescription</a></li>
        <li class="breadcrumb-item active">Show #{{ $prescription->code }}</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4>Prescription Show</h4>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

@push('script')
<script type="text/javascript">
  const urlSignaData = '{{ route("signa.load-data") }}';
  const urlMedicineData = '{{ route("medicine.load-data") }}';
  const urlGetMedicine = '{{ route("medicine.get-data") }}';
  const urlStorePrescription = '{{ route("prescription.store") }}';
</script>
<script type="text/javascript" src="{{ asset('assets/js/prescription/form.js') }}"></script>
@endpush

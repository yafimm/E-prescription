  <div class="row py-3">
    <div class="col-md-4">
      <label for="validationCustom01" class="form-label">Prescription Code</label>
      <input type="text" class="form-control" id="validationCustom01" value="{{ HelperSetPrescriptionCode() }}" readonly>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 offset-md-4">
      <label for="validationCustom01" class="form-label">Date</label>
      <input type="text" class="form-control" id="validationCustom01" value="{{ date('d/m/Y') }}" readonly>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>

  <!-- Information Patient -->
  <div class="row py-3">
    <div class="col-12 border-bottom my-2">
      <h5>Patient Information</h5>
    </div>
    <div class="col-md-4 col-sm-12 col-12">
      <label for="validationCustom01" class="form-label">Name</label>
      <input type="text" class="form-control" name="patient_name" value="">
    </div>
    <div class="col-md-4 col-sm-6 col-6">
      <label for="validationCustom02" class="form-label">Gender</label>
      <select class="form-control" name="patient_gender">
        <option value="pria">Pria</option>
        <option value="wanita">Wanita</option>
      </select>
    </div>
    <div class="col-md-4 col-sm-6 col-6">
      <label for="validationCustom03" class="form-label">Age</label>
      <input type="text" class="form-control" name="patient_age">
    </div>
  </div>

  <!-- Prescription Item -->
  <div class="row ">
    <div class="col-12 border-bottom my-2">
      <h5>Prescription Form</h5>
    </div>
    <div class="col-md-8 col-sm-8 col-12 py-1">
      <label for="validationCustom01" class="form-label">Name</label>
      <input type="text" class="form-control" name="prescription_name" id="validationCustom01" value="">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-4 col-sm-4 col-12 py-1">
      <label for="validationCustom01" class="form-label">Type</label>
      <select class="form-control" id="type" name="prescription_type">
        <option value="racikan">Racikan</option>
        <option value="non-racikan" selected>Non Racikan</option>
      </select>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-sm-12 col-md-8">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-12 py-1">
          <label for="validationCustom01" class="form-label">Signa</label>
          <select class="form-control" id="signa_id" name="signa_id"></select>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-12 py-1">
          <label for="validationCustom01" class="form-label">Medicine</label>
          <select class="form-control" id="medicine_id" name="medicine_id"></select>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-4">
      <table class="table table-sm">
        <thead>
          <th>No</th>
          <th>Name</th>
          <th>Qty</th>
          <th>Stock</th>
          <th>#</th>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Tes</td>
            <td>1</td>
            <td>2</td>
            <td><i class="fas fa-trash-alt"></i></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-12 float-right py-3">
      <button class="btn btn-danger" id="js-clear-prescription-form" type="button"><i class="fas fa-eraser"></i> Reset</button>
      <button class="btn btn-primary" id="js-add-prescription-item" type="button"><i class="fas fa-plus"></i> Add</button>
    </div>
  </div>
  <div class="row py-3">
    <div class="col-12 border-bottom my-2">
      <h5>Prescription Items</h5>
    </div>


    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-sm table-striped small" id="prescription-datatable">
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>

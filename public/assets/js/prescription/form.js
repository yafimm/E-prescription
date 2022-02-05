$(document).ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
      }
  });

  var prescriptionItems = [];
  var medicinesList = [];
  var medicineConcoction = [];

  var concoctionTable = $('#concoction-datatable').DataTable({
      searching    : false,
      lengthChange : false,
      info         : false,
      responsive   : true,
      paginate     : false,
      autoWidth    : false,
      columns: [
                {
                    name: 'prescription-item-name',
                    title: 'Name',
                    width: "20%",
                },
                {
                    name: 'prescription-item-quantity',
                    title: 'Qty',
                    width: "10%",
                },
                {
                    title: '#',
                    width: "5%",
                    name: "action",
                },
      ],
  });

  var prescriptionItemsTable = $('#prescription-datatable').DataTable({
      searching    : false,
      lengthChange : false,
      info         : false,
      responsive   : true,
      autoWidth    : false,
      columns: [
                {
                    title: 'No',
                    name: 'table-no',
                    width: "5%",
                },
                {
                    name: 'prescription-item-name',
                    title: 'Name',
                    width: "20%",
                },
                {
                    name: 'prescription-item-type',
                    title: 'Type',
                    width: "10%",
                },
                {
                    name: 'prescription-item-detail',
                    title: 'Medicine',
                    width: "30%",
                },
                {
                    name: 'prescription-item-qty-concuction',
                    title: 'Qty/1',
                    width: "5%",
                },
                {
                    name: 'prescription-item-quantity',
                    title: 'Qty',
                    width: "10%",
                },
                {
                    name: 'prescription-item-stock',
                    title: 'Stock',
                    width: "10%",
                },
                {
                    title: '#',
                    width: "5%",
                    name: "action",
                },
      ],
      pageLength: '20',
      rowsGroup: [// Always the array (!) of the column-selectors in specified order to which rows groupping is applied
                   // (column-selector could be any of specified in https://datatables.net/reference/type/column-selector)
         'table-no:name',
         'prescription-item-name:name',
         'prescription-item-type:name',
         'prescription-item-quantity:name',
         'action:name',
       ],
  });


  $('#signa_id').select2({
      placeholder : 'Search for signa ..',
      minimumInputLength: 2,
      width: '100%',
      theme: 'bootstrap4',
      ajax : {
        url      : urlSignaData,
        type     : 'get',
        dataType : 'json',
        delay    : 250,
        data: function (params) {
         return {
           q: params.term, // search term
           // single_item: true
         };
        },
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.signa_kode + ' - ' + item.signa_nama,
                id: item.signa_id
              }
            })
          };
        },
        cache: true
      }
  });

  $('#medicine_id').select2({
      placeholder : 'Search for medicine ..',
      minimumInputLength: 2,
      width: '100%',
      theme: 'bootstrap4',
      ajax : {
        url      : urlMedicineData,
        type     : 'get',
        dataType : 'json',
        delay    : 250,
        data: function (params) {
         return {
           q: params.term, // search term
           // single_item: true
         };
        },
        processResults: function (data) {
           return {
             results:  $.map(data, function (item) {
               return {
                 text: item.obatalkes_kode + ' - ' + item.obatalkes_nama,
                 id: item.obatalkes_id,
               }
             })
           };
         },
         cache: true
       }
  });

  $('#medicine_id').change(function(){
    if($('select[name="prescription_type"] option:selected').val() == 'racikan'){
      $.ajax({
        type: 'get', //THIS NEEDS TO BE GET
        url: urlGetMedicine,
        dataType: 'json',
        data: {medicine_id: $(this).val()},
        success: function (result) {
          if(result.status == false){
              $('#cari').empty();
              Swal.fire('Oops!', result.message,'error');
          }else{
              //Kalo data sudah ada di detail, keluar alert
              if(medicineConcoction.includes(result.data.id)){
                  swal('Failed', result.data.name + ' already exists!', 'error');
                  $('#cari').empty();
              }else{
                  const medicine = {
                    id: result.data.obatalkes_id,
                    name: result.data.obatalkes_kode+' - '+result.data.obatalkes_nama,
                    stock: result.data.stok,
                    qty: 0,
                  };

                  addItemToConcoction(medicine);

                  $('#medicine_id').empty();
                  Swal.fire('Success', 'You have added '+medicine.name+ ' to concoction', 'success');
            }

        }

      },error:function (request, status, error){
          Swal.fire(
            'Oops!',
            'Something wrong!, please contact admin.',
            'error'
          );
          console.log(status);
        }
      });
    }
  });

  $('select[name="prescription_type"]').on('change', function(){
      if($(this).val() == 'racikan'){
        $('#js-medicine-concoction').show();
        // $('#js-medicine-concoction').css('display','block');
      }else{
        $('#js-medicine-concoction').hide();
      }
      // $('#js-medicine-concoction').css('display','none');

  });

  $('#js-add-prescription-item').on('click', function(){
    if(validatePrescription()){
      const prescriptionName      = $('input[name="prescription_name"]').val();
      const prescriptionType      = $('select[name="prescription_type"] option:selected').val();
      const prescriptionSignaId   = $('select[name="signa_id"] option:selected').val();
      const prescriptionSignaName = $('select[name="signa_id"] option:selected').html();

      // Check the prescription name already in list
      if(prescriptionItems.some( prescriptionItem => prescriptionItem['name'] != prescriptionName ) || prescriptionItems.length == 0){
        let medicines;

        if($('select[name="prescription_type"] option:selected').val() != 'racikan'){
          //Get Medicine data for non racikan
          $.ajax({
              type: 'get', //THIS NEEDS TO BE GET
              url: urlGetMedicine,
              dataType: 'json',
              data: {medicine_id: $('select[name="medicine_id"] option:selected').val()},
              success: function (result) {
                if(result.status == false){
                  $('#medicine_id').empty();
                  Swal.fire('Oops!', result.message,'error');
                }else{
                    medicines = [{id: result.data.obatalkes_id,
                                  name: result.data.obatalkes_kode+' - '+result.data.obatalkes_nama,
                                  stock: result.data.stok,
                                  qty: 1,}];
                    //check if medicine already exist in table
                    medicines.forEach((medicine, i) => {
                      //Find index of specific object using findIndex method.
                      let medicineListIndex = medicinesList.findIndex((obj => obj.id == medicine.id));
                      if(medicinesList[medicineListIndex] === true){
                        medicinesList[medicineListIndex].stock = medicine.stock;
                      }else{
                        medicinesList.push(medicine);
                      }
                    });

                    const prescriptionItem = {
                      name: prescriptionName,
                      type: prescriptionType,
                      qty: 0,
                      medicines: medicines,
                      signa: {
                        id: prescriptionSignaId,
                        name: prescriptionSignaName,
                      }
                    };


                    addItem(prescriptionItem);

                    clearPrescriptionForm();

                    Swal.fire('Success!','You have added '+prescriptionItem.name,'success');

                }
              },error:function (request, status, error){
                  Swal.fire('Oops!','Something wrong!, please contact admin.','error');
                  console.log(error);
              }
          });
        }else{
          // store medicineConcoction to medicine for store to prescription item
          medicines = medicineConcoction;

          // clear datatable and concoction
          concoctionTable.clear().draw();
          medicineConcoction = [];
          //check if medicine already exist in table
          medicines.forEach((medicine, i) => {
            //Find index of specific object using findIndex method.
            let medicineListIndex = medicinesList.findIndex((obj => obj.id == medicine.id));
            if(medicinesList[medicineListIndex] === true){
              medicinesList[medicineListIndex].stock = medicine.stock;
            }else{
              medicinesList.push(medicine);
            }
          });

          const prescriptionItem = {
            name: prescriptionName,
            type: prescriptionType,
            qty: 0,
            medicines: medicines,
            signa: {
              id: prescriptionSignaId,
              name: prescriptionSignaName,
            }
          };

          addItem(prescriptionItem);

          clearPrescriptionForm();

          Swal.fire('Success!','You have added '+prescriptionItem.name,'success');
        }


      }else{
        Swal.fire('Oops!',prescriptionName+' Already in list Prescription items','error')
      }
    }else{
      Swal.fire('Oops!', 'You have to complete the name, signa, and (concoction if type is "racikan")','error')
    }
  });

  $('#js-clear-prescription-form').on('click', function(){
      clearPrescriptionForm();
  });

  // Delete item in prescription table
  $(document).on('click', '.js-delete-prescription-item', function(e){
      e.preventDefault();
      const row = $(this).parents('tr');
      removeItem(row);
  });

  // Remove item in concoction table
  $(document).on('click', '.js-delete-concoction-item', function(e){
      e.preventDefault();
      const row = $(this).parents('tr');
      removeConcoctionItem(row);
  });

  $(document).on('keypress', '.js-prescription-item-qty, .js-concoction-item-qty', function(e){
    const charCode = (e.which) ? e.which : event.keyCode;
    if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
  });
  //Trigger for in and out stock on inventory
  $(document).on('keyup change', '.js-prescription-item-qty', function(e){
      let medicine;

      const value = $(this).val() != '' ? parseInt($(this).val()) : '';
      const prescriptionItem = prescriptionItems.filter(item => item.name == $(this).data('prescription'))[0];
      // const medicine = medicinesList.filter(item => item.id == $(this).data('id'))[0]; // get
      // check if the prescription is exists otherwise skip
      if(prescriptionItem.medicines){
        // Looping according to the medicines
        for (var i = 0; i < prescriptionItem.medicines.length; i++) {
          medicine = medicinesList.filter(item => item.id == prescriptionItem.medicines[i].id)[0];
          // Take prescription item has same medicine with the value changed
          const prescriptionItemsMedicine = prescriptionItems.filter(item => item.medicines.some(medicine => medicine.id == prescriptionItem.medicines[i].id ));

          // Get all value from same item (not in stock)
          let values = 0;
          prescriptionItemsMedicine.forEach((prescriptionItemMedicine, j) => {
            //Get Medicine obj from array obj prescriptionitem
            let prescriptionItemMedicineObj = prescriptionItemMedicine.medicines.filter(medicine => medicine.id == prescriptionItem.medicines[i].id)[0];
            // Base qty * qty prescription
            if(prescriptionItemMedicine.name == prescriptionItem.name){
              // Sum values for this change input
              values += parseInt(prescriptionItemMedicineObj.qty * value);
            }else{
              values += parseInt(prescriptionItemMedicineObj.qty * prescriptionItemMedicine.qty);
            }
          });

          // Count all value from same item (not in stock)
          const sumValues = values;

          // If the value of the quantity needed is less than the stock, the amount will adjust the rest
          if(medicine.stock < sumValues){
            // set new value if, old value exceeds the total stock by adjusting the quantity and trigger the function again
            $(this).val(parseInt(medicine.stock - (sumValues - value))).trigger('change');
          }else{
            //update obj qty value
            let prescriptionIndex = prescriptionItems.findIndex(item => item.name == $(this).data('prescription'));
            prescriptionItems[prescriptionIndex].qty = parseInt($(this).val());
            $(this).val($(this).val() == '' ? 0 : parseInt($(this).val()));

            // Set the product stock available
            $('.js-prescription-item-stock[data-medicine="'+medicine.id+'"]').val(parseInt(medicine.stock - sumValues));
          }
        }
      }
  });

  $(document).on('keyup change', '.js-concoction-item-qty', function(e){
      let medicineIndex = medicineConcoction.findIndex(item => item.id == $(this).data('medicine'));
      if(medicineConcoction[medicineIndex]){
        //Update qty concoction item
        medicineConcoction[medicineIndex].qty = parseInt($(this).val());
      }
  });

  $('form#prescription-store').validate({
          ignore: false,
          errorClass: 'is-invalid',
          rules: {
            patient_name: {
              required: true,
              minlength: 3,
              maxlength: 64,
              // The value of `this` inside the `normalizer` is the corresponding
              // DOMElement. In this example, `this` references the `username` element.
              normalizer: function(value) {
                return $.trim(value);
              }
            },
            patient_gender: {
              required: true,
            },
            patient_age: {
              required: true,
              digits: true
            }
          },
          errorPlacement: function(error, element) {
             var customError = $([
               '<span class="invalid-feedback d-block">',
               '</span>'
             ].join(""));

             // Add `form-error-message` class to the error element
             error.addClass("form-error-message");

             // Insert it inside the span that has `mb-0` class
             error.appendTo(customError);

             // Insert your custom error
             customError.insertAfter( element );
           },
          submitHandler: function(form) {
            if(prescriptionItems.length > 0){

              $('button[type=submit]', 'form#prescription-store').attr('disabled', true);

              Swal.fire({
                title: 'Are you sure you want to submit data?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
              }).then((accept) => {
                if (accept) {
                  $.ajax({
                      type: 'POST', //THIS NEEDS TO BE GET
                      url: urlStorePrescription,
                      dataType: 'json',
                      data: {
                        patient_name   : $('input[name="patient_name"]').val(),
                        patient_age    : $('input[name="patient_age"]').val(),
                        patient_gender : $('select[name="patient_gender"] option:selected').val(),
                        prescription_items  : prescriptionItems,
                      },
                      success: function (result) {
                        if(result.status == false){
                          Swal.fire('Oops!', result.message,'error');
                        }else{
                          Swal.fire(
                            'Success!',
                            'You have success stored the data.',
                            'success'
                          )
                          window.location.replace(result.data.urlRedirect);
                        }

                      },error:function (request, status, error){
                        Swal.fire(
                          'Oops!',
                          'Something wrong!, please contact admin.',
                          'error'
                        );

                       console.log(error);
                      }
                    });
                  }else{
                      $('button[type=submit]', 'form#prescription-store').removeAttr("disabled");
                  }
              });
            }else{
              Swal.fire(
                'Warning!',
                'The Prescription item must be at least 1 item.',
                'error'
              )
            }


            // $('#confirmation').modal('show');


          }
    });

  // add item to array and table
  function addItem(data)
  {
      prescriptionItems.push(data);

      data.medicines.forEach((item, i) => {

        prescriptionItemsTable.row.add([
          prescriptionItems.length,
          '<div class="font-weight-bold">'+data.name+'</div><div>'+data.signa.name+'</div>',
          data.type,
          item.name,
          item.qty,
          '<input type="text" class="form-control form-control-sm js-prescription-item-qty" data-prescription="'+data.name+'"" name="qty[]" value="0">',
          '<input type="text" class="form-control form-control-sm js-prescription-item-stock" data-medicine="'+item.id+'"" id="" value="" readonly>',
          '<a href="#" class="btn btn-danger btn-sm js-delete-prescription-item"><i class="fas fa-trash-alt"></i></a>'
        ]).node().id ='prescription-item-'+data.name;


        prescriptionItemsTable.draw(false);
      });


      loadAvailableStock();
  }

  // Remove Item
  function removeItem(row)
  {
      Swal.fire({
        title: 'Are you sure you want to delete data?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          prescriptionItemsTable.row(row).remove().draw();

          // if row deleted, reload the data
          loadAvailableStock();

          Swal.fire(
            'Deleted!',
            'The data has been deleted.',
            'success'
          )
        }
      })
  }

  // Add Item concoction
  function addItemToConcoction(data)
  {
      medicineConcoction.push(data);

      concoctionTable.row.add([
          data.name,
          '<input type="text" class="form-control form-control-sm js-concoction-item-qty" data-medicine="'+data.id+'"" name="concoction_qty[]" value="0">',
          '<a href="#" class="btn btn-danger btn-sm js-delete-concoction-item"><i class="fas fa-trash-alt"></i></a>'
      ])

      concoctionTable.draw(false);

      // loadAvailableStock();
  }

  // Remove Item
  function removeConcoctionItem(row)
  {
      Swal.fire({
        title: 'Are you sure you want to delete concoction item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          concoctionTable.row(row).remove().draw();
        }
      })
  }

  // Clear form
  function clearPrescriptionForm()
  {
      $('input[name="prescription_name"]').val('');
      $('#medicine_id').empty();
      $('#signa_id').empty();
  }

  function loadAvailableStock()
  {
      medicinesList.map((medicine) => {
        for (var i = 0; i < prescriptionItems.length; i++) {
          // Take prescription item has same medicine with the value changed
          const prescriptionItemsMedicine = prescriptionItems.filter(prescriptionItem => prescriptionItem.medicines.some(itemMedicine => itemMedicine.id == medicine.id ));

          // Get all value from same item (not in stock)
          let values = 0;
          prescriptionItemsMedicine.forEach((prescriptionItemMedicine, j) => {
            let itemMedicine = prescriptionItemMedicine.medicines.filter(itemMedicine => itemMedicine.id == medicine.id)[0];
            // Base qty * qty prescription
            values += parseInt(itemMedicine.qty * prescriptionItemMedicine.qty);
          });

          const sumValues = values;
          $('.js-prescription-item-stock[data-medicine="'+medicine.id+'"]').val(parseInt(medicine.stock - sumValues));
        }
          // let values     = $('.js-prescription-item-qty[data-prescription="'+item.name+'"]').map(function(){return $(this).val() ? parseInt($(this).val()) : 0 ;}).get();
          // let sumValues = values.reduce((a,b) => a + b, 0);
          // $('.js-prescription-item-stock[data-medicine="'+item.id+'"]').val(item.stock - sumValues);
      });
  }

  function validatePrescription()
  {
    if($('input[name="prescription_name"]').val() == '') return false;
    if($('select[name="prescription_type"] option:selected').val() == '') return false;
    if($('select[name="signa_id"] option:selected').val() == '') return false;

    if($('select[name="prescription_type"] option:selected').val() == 'racikan' && medicineConcoction.length > 0){
      return true
    }else if($('select[name="prescription_type"] option:selected').val() == 'non-racikan'){
      if($('select[name="signa_id"] option:selected').val() != '') return true
    }

    return false;

  }

});

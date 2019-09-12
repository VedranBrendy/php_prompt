const btnSubmit = document.querySelector('#btnSubmit');
//Get data from DB for index.php
function getDataFromDB() {
  //Ajax to get data from DB
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'getDataFromDB.php', true);
  xhr.onload = function () {

    if (this.status == 200) {

      document.getElementById('text').innerHTML = this.responseText;

    }
  }
  xhr.send();
}

getDataFromDB();

//Load all event listeners
loadEventLiteners();

function loadEventLiteners() {
  btnSubmit.addEventListener('click', submitPrompt);

}



//Ajax for insert data from textarea prompt into DB
function submitPrompt() {

  bootbox.prompt({
    title: "This is a prompt with a textarea!",
    inputType: 'textarea',
    callback: function (result) {
      //If textarea empty show alert with message
      if (result === '') {
        bootbox.alert('Texarea  cen\'t be empty');
        //else create ajax request
      } else {

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'addToDB.php?result=' + result, true);
        xhr.onload = function () {
          //If response successful -alert success
          if (xhr.readyState == 4 && xhr.status == 200) {
            if (this.responseText === '1') {
              //Alert if data added successfully
              /*  bootbox.alert('Data Added'); */
              //on success get new data from database
              getDataFromDB();
            }
            //If cancelled show alert message - testig purpose
            else if (this.responseText === '0') {
              /* bootbox.alert('Canceled'); */
            }
            console.log(this.responseText);
          }
        }
        xhr.send();

      }

    }

  })

}


//Ajax for delete data 
function deleteData(id) {

  bootbox.confirm({
    message: "Delete data?",
    buttons: {
      confirm: {
        label: 'Yes',
        className: 'btn-success'
      },
      cancel: {
        label: 'No',
        className: 'btn-danger'
      }
    },
    callback: function (result) {

      if (result === true) {

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'deleteData.php?id=' + id, true);
        xhr.onload = function () {

          if (xhr.readyState == 4 && xhr.status == 200) {

            if (this.responseText === '1') {
              //If response successful -alert success
              /* bootbox.alert('Data Deleted'); */

              //on success get new data from database
              getDataFromDB();
            } else {
              bootbox.alert(this.responseText + 'eror');
            }
          }
        }
        xhr.send();

      }
      /*  console.log('This was logged in the callback: ' + result); */
    }
  });

}



function updateData(id) {

  //Read details to fill prompt with data from DB
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'readDetails.php?id=' + id, true);
  xhr.onload = function () {
    //If response successful -alert success
    if (xhr.status == 200) {
      var detail = JSON.parse(this.responseText);
      var output = detail.text;
      /* console.log(this.responseText); */

      bootbox.prompt({
        title: "Update textarea!",
        inputType: 'textarea',
        value: innerHTML = output,
        callback: function (result) {

          //If textarea empty show alert with message
          if (result === '') {
            bootbox.alert('Texarea  cen\'t be empty');
          //else create ajax request
          } else {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'updateData.php?id=' + id + '&result=' + result, true);
            xhr.onload = function () {
              //If response successful -alert success
              if (xhr.status == 200) {
                if (this.responseText === '1') {
                  //Alert if data added successfully
                  /*  bootbox.alert('Data Updated'); */
                  getDataFromDB();
                }
                //If cancelled show alert message - testig purpose
                else if (this.responseText === '0') {
                  //* bootbox.alert('Canceled');
                }
              }
            }
            xhr.send();

          }
        }
      })

    }
  }
  xhr.send();


}



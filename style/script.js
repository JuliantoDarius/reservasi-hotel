function handleDetail(span) {
   span.parentElement.parentElement.classList.remove("card-height");
   span.parentElement.textContent = span.nextElementSibling.value;      
}

function handlePesan() {
   const checkin = $("#check-in").val();
   const checkout = $("#check-out").val();
   const jumlahKamar = $("#jumlahKamar").val();
   
   document.querySelector("#inputCheckIn").value = checkin;
   document.querySelector("#inputCheckOut").value = checkout;
   document.querySelector("#inputJumlahKamar").value = jumlahKamar;
}

function handleEnter(e) {
   if(e.which == 13 || e.keyCode == 13) {
      handlePesan();
   }
}

function handleBtn(btn, direct) {
   if(btn.id == "blmLogin") {
      alert("Anda Harus Melakukan Login Terlebih Dahulu !");
      document.location.href = "../../login.php";
      return false;
   }


   const xhr = new XMLHttpRequest();
   xhr.onreadystatechange = () => {
      if (xhr.status === 200 && xhr.readyState === 4) {
         document.querySelector(".article").innerHTML = xhr.responseText;
      }
   };

   xhr.open("GET", direct);
   xhr.send();

   btn.style.display = "none";
}

function handleSearch() {
   const tgl = document.querySelector("#search-tgl-checkin").value;
   const search = document.querySelector("#search").value;

   const xhr = new XMLHttpRequest();
   xhr.onreadystatechange = () => {
      if(xhr.status === 200 && xhr.readyState === 4) {
         document.querySelector("#reservation-list").innerHTML = xhr.responseText;
      }
   };

   xhr.open("GET", `../ajax/ajaxSearch.php?tgl=${tgl}&key=${search}`);
   xhr.send();
}

const alertDiv = document.querySelector("#alert");
alertDiv.addEventListener("click", function (e) {
   alertDiv.style.display = "none";
});
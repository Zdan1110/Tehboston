@section ('Title')
Laporan
@endsection
@extends('kasir.template_kasir')
@section('content')  
  <div class="main">

    <!-- FILTER DI ATAS TABEL -->
    <div class="filter-section" style="margin-bottom: 15px;">
      <label for="filter-date"><strong>Filter Tanggal:</strong></label>
      <input type="date" id="filter-date" onchange="filterHistory()" />
    </div>

    <!-- TOMBOL CETAK PDF -->
    <div style="margin-bottom: 15px;">
      <button onclick="cetakPDF()">Cetak PDF</button>
    </div>

    <!-- TABEL HISTORI -->
    <table id="history-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Menu</th>
          <th>Harga</th>
          <th>Waktu</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<script>
let total = 0;
let count = 0;
let orderHistory = JSON.parse(localStorage.getItem("orderHistory")) || [];

function addToOrder(name, price) {
  const kode = document.getElementById("kode-pelanggan").value || "Umum";
  const orderList = document.getElementById("order-list");
  const listItem = document.createElement("li");

  const itemText = document.createElement("span");
  itemText.textContent = `${name} - Rp${price.toLocaleString("id-ID")}`;

  const deleteBtn = document.createElement("span");
  deleteBtn.textContent = "❌";
  deleteBtn.className = "delete";
  deleteBtn.onclick = () => {
    orderList.removeChild(listItem);
    total -= price;
    document.getElementById("total").textContent = `Total: Rp${total.toLocaleString("id-ID")}`;
  };

  listItem.appendChild(itemText);
  listItem.appendChild(deleteBtn);
  orderList.appendChild(listItem);

  total += price;
  document.getElementById("total").textContent = `Total: Rp${total.toLocaleString("id-ID")}`;
}

function checkoutOrder() {
  const kode = document.getElementById("kode-pelanggan").value.trim();
  const listItems = document.querySelectorAll("#order-list li");
  if (!kode) return alert("Silakan masukkan nama pelanggan.");
  if (listItems.length === 0) return alert("Tidak ada pesanan.");

  const now = new Date();
  let htmlRows = "";

  listItems.forEach(li => {
    const text = li.textContent.replace("❌", "").trim();
    htmlRows += `<tr><td>${++count}</td><td>${kode}</td><td>${text.split(" - ")[0]}</td><td>${text.split(" - ")[1]}</td><td>${now.toLocaleString("id-ID")}</td><td><button class='btn btn-edit' onclick='editRow(this)'>Edit</button><button class='btn btn-delete' onclick='deleteRow(this)'>Hapus</button></td></tr>`;

    orderHistory.push({ kode, menu: text.split(" - ")[0], harga: text.split(" - ")[1], waktu: now.toISOString() });
  });

  document.querySelector("#history-table tbody").insertAdjacentHTML("beforeend", htmlRows);
  document.getElementById("order-list").innerHTML = "";
  total = 0;
  document.getElementById("total").textContent = "Total: Rp0";

  // Simpan ke localStorage
  localStorage.setItem("orderHistory", JSON.stringify(orderHistory));
}

function deleteRow(button) {
  const row = button.closest("tr");
  row.remove();
  const kode = row.cells[1].textContent;
  const menu = row.cells[2].textContent;
  const waktu = row.cells[4].textContent;

  orderHistory = orderHistory.filter(item =>
    !(item.kode === kode && item.menu === menu && new Date(item.waktu).toLocaleString("id-ID") === waktu)
  );
  localStorage.setItem("orderHistory", JSON.stringify(orderHistory));
}

function editRow(button) {
  const row = button.closest("tr");
  const nameCell = row.cells[2];
  const priceCell = row.cells[3];
  const currentName = nameCell.textContent;
  const currentPrice = priceCell.textContent.replace(/[^\d]/g, "");

  nameCell.innerHTML = `<input type='text' value='${currentName}' />`;
  priceCell.innerHTML = `<input type='number' value='${currentPrice}' />`;
  button.textContent = "Simpan";
  button.classList.replace("btn-edit", "btn-save");
  button.onclick = () => {
    const newName = nameCell.querySelector("input").value;
    const newPrice = parseInt(priceCell.querySelector("input").value);
    nameCell.textContent = newName;
    priceCell.textContent = `Rp${newPrice.toLocaleString("id-ID")}`;
    button.textContent = "Edit";
    button.classList.replace("btn-save", "btn-edit");
    button.onclick = () => editRow(button);
  };
}

function filterHistory() {
  const dateInput = document.getElementById("filter-date").value;
  const tbody = document.querySelector("#history-table tbody");
  tbody.innerHTML = "";
  let no = 1;
  orderHistory.forEach(item => {
    if (!dateInput || item.waktu.startsWith(dateInput)) {
      tbody.innerHTML += `<tr><td>${no++}</td><td>${item.kode}</td><td>${item.menu}</td><td>${item.harga}</td><td>${new Date(item.waktu).toLocaleString("id-ID")}</td><td><button class='btn btn-edit' onclick='editRow(this)'>Edit</button><button class='btn btn-delete' onclick='deleteRow(this)'>Hapus</button></td></tr>`;
    }
  });
}

// CETAK PDF
function cetakPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  const title = "Histori Pembelian - Teh Boston";
  const headers = [["No", "Pelanggan", "Menu", "Harga", "Waktu"]];
  const rows = [];

  let no = 1;
  orderHistory.forEach(item => {
    rows.push([
      no++,
      item.kode,
      item.menu,
      item.harga,
      new Date(item.waktu).toLocaleString("id-ID")
    ]);
  });

  doc.setFontSize(14);
  doc.text(title, 20, 20);
  doc.autoTable({
    startY: 30,
    head: headers,
    body: rows,
    theme: 'striped',
    headStyles: { fillColor: [41, 128, 185] },
  });

  doc.save("histori-pembelian.pdf");
}

// Tampilkan histori saat halaman dimuat
window.onload = () => {
  filterHistory();
};
</script>
@endsection

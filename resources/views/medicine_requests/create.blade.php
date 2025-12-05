@extends('layouts.guest')

@section('content')
<div style="background: var(--dark); color: white; padding: 100px 0 50px; text-align: center;">
    <h1>Request Medicines</h1>
    <p>Upload prescription or list your medicines</p>
</div>

<section class="section">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; box-shadow: var(--shadow);">
            
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('medicine_requests.store') }}" method="POST" enctype="multipart/form-data" id="medicineForm">
                @csrf
                
                <h3 style="margin-bottom: 20px;">Patient Details</h3>
                <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 20px;">
                    <div class="col" style="flex: 1;">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col" style="flex: 1;">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" required placeholder="Mobile Number">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Delivery Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Full Address"></textarea>
                </div>

                <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

                <h3 style="margin-bottom: 20px;">Medicines</h3>
                
                <!-- Dynamic Medicine List -->
                <div id="medicine-list">
                    <div class="medicine-row" style="display: flex; gap: 10px; margin-bottom: 10px;">
                        <input type="text" class="form-control med-name" placeholder="Medicine Name" style="flex: 3;">
                        <input type="text" class="form-control med-qty" placeholder="Qty" style="flex: 1;">
                        <button type="button" class="btn btn-danger remove-row" style="padding: 0 10px; background: #e74c3c;">X</button>
                    </div>
                </div>
                
                <button type="button" id="add-medicine" class="btn" style="background: #2ecc71; font-size: 0.9rem; padding: 8px 15px; margin-bottom: 20px;">+ Add Another Medicine</button>
                
                <!-- Hidden input to store JSON -->
                <input type="hidden" name="medicines" id="medicines-json">

                <div class="form-group" style="margin-top: 20px;">
                    <label>Upload Prescription <span style="color: red;">*</span></label>
                    <input type="file" name="prescription" class="form-control" accept="image/*" style="padding: 10px;" required>
                </div>

                <br>
                <button type="submit" class="btn" style="width: 100%; font-size: 1.1rem;">Submit Request</button>

            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const list = document.getElementById('medicine-list');
        const addBtn = document.getElementById('add-medicine');
        const form = document.getElementById('medicineForm');
        const jsonInput = document.getElementById('medicines-json');

        // Add Row
        addBtn.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'medicine-row';
            row.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px;';
            row.innerHTML = `
                <input type="text" class="form-control med-name" placeholder="Medicine Name" style="flex: 3;">
                <input type="text" class="form-control med-qty" placeholder="Qty" style="flex: 1;">
                <button type="button" class="btn btn-danger remove-row" style="padding: 0 10px; background: #e74c3c;">X</button>
            `;
            list.appendChild(row);
        });

        // Remove Row
        list.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                // Don't remove the last row if it's the only one? Maybe allow it but warn.
                if (list.children.length > 1) {
                    e.target.parentElement.remove();
                } else {
                    // Clear inputs instead
                    e.target.parentElement.querySelector('.med-name').value = '';
                    e.target.parentElement.querySelector('.med-qty').value = '';
                }
            }
        });

        // On Submit, Compile JSON
        form.addEventListener('submit', function(e) {
            const rows = document.querySelectorAll('.medicine-row');
            let data = [];
            rows.forEach(row => {
                const name = row.querySelector('.med-name').value.trim();
                const qty = row.querySelector('.med-qty').value.trim();
                if (name) {
                    data.push({ name: name, qty: qty });
                }
            });
            
            // medicines list is optional now if prescription is provided, but we still parse it if present
            jsonInput.value = JSON.stringify(data);
        });
    });
</script>
@endpush
@endsection

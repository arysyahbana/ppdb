 {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
 <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script>
     AOS.init();
 </script>

 <script>
     const anggaranInput = document.getElementById('anggaran');

     anggaranInput.addEventListener('input', function(e) {
         let value = e.target.value;

         // Remove all non-numeric characters except for commas (for decimal) and dots (for thousand separators)
         value = value.replace(/[^0-9]/g, '');

         // Format the number as currency
         const formattedValue = formatCurrency(value);

         // Set the input value to the formatted currency
         anggaranInput.value = formattedValue;
     });

     // Helper function to format a numeric value as currency
     function formatCurrency(value) {
         // Ensure the value is not empty or just zeros
         if (!value) return '';

         // Convert the value to a number
         let numberValue = Number(value);

         // Format the number with 'Rp' and thousand separators
         return 'Rp ' + numberValue.toLocaleString('id-ID');
     }
 </script>

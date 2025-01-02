document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('input[id^="quantidade-"]');
    
    quantityInputs.forEach(input => {
        input.addEventListener('keydown', function(e) {
            if(e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E' || e.key === '.') {
                e.preventDefault();
            }
        });

        input.addEventListener('input', function() {
            let value = Math.abs(parseInt(this.value) || 1);
            value = Math.max(1, Math.floor(value));
            this.value = value;
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            let pastedValue = Math.abs(parseInt(e.clipboardData.getData('text')) || 1);
            this.value = Math.max(1, Math.floor(pastedValue));
        });

        input.addEventListener('blur', function() {
            let value = Math.abs(parseInt(this.value) || 1);
            this.value = Math.max(1, Math.floor(value));
        });
    });
}); 
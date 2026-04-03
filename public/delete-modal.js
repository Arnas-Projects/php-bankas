const modal = document.getElementById('deleteModal');
const modalText = document.getElementById('modalText');
const deleteIdInput = document.getElementById('deleteId');

document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => {

        const balance = parseFloat(form.querySelector('input[name="balance"]').value);
        const name = form.querySelector('input[name="name"]').value;
        const id = form.querySelector('input[name="id"]').value;

        if (balance > 0) {
            return;
        }

        e.preventDefault();

        modalText.textContent =
            `Ar tikrai norite ištrinti ${name} banko sąskaitą?`;

        deleteIdInput.value = id;

        modal.classList.add('active');
    });
});
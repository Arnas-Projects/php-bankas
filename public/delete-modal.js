const modal = document.getElementById('deleteModal');
const modalText = document.getElementById('modalText');
const deleteIdInput = document.getElementById('deleteId');
const cancelBtn = document.getElementById('cancelBtn');

document.querySelectorAll('.destroy-btn').forEach(button => {
    button.addEventListener('click', _ => {
        const id = button.dataset.id;
        const name = button.dataset.name;

        modalText.textContent = `Ar tikrai norite ištrinti ${name} banko sąskaitą?`;

        deleteIdInput.value = id;

        modal.classList.add('active');
    });
});

cancelBtn.addEventListener('click', () => {
    modal.classList.remove('active');
});
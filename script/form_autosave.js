window.onload = () => {
	const formInputs = document.querySelectorAll("input, select");

	formInputs.forEach((input) => {
		let value = localStorage.getItem(input.name);
		if (value) {
			input.value = value;
		}

		input.addEventListener("input", () => {
			localStorage.setItem(input.id, input.value);
		});
	});
};

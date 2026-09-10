const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');
const preview = document.getElementById('preview');

let allFiles = []; // наше хранилище файлов

function addFiles(newFiles) {
	Array.from(newFiles).forEach(f => {
		const isDuplicate = allFiles.some(e =>
			e.name === f.name && e.size === f.size
		);
		
		if (!isDuplicate) {
			allFiles.push(f);
		}
	});
	
	updateInputFiles();
	renderPreview();
}

function updateInputFiles() {
	const dt = new DataTransfer();
	allFiles.forEach(f => dt.items.add(f));
	fileInput.files = dt.files;
}

function renderPreview() {
	preview.innerHTML = '';
	
	allFiles.forEach((file, index) => {
		const reader = new FileReader();
		reader.onload = e => {
			const div = document.createElement('div');
			div.className = 'thumb';
			
			const img = document.createElement('img');
			img.src = e.target.result;
			
			const btn = document.createElement('button');
			btn.textContent = '×';
			
			btn.onclick = () => {
				allFiles.splice(index, 1);
				updateInputFiles();
				renderPreview();
			};
			
			div.appendChild(img);
			div.appendChild(btn);
			preview.appendChild(div);
		};
		reader.readAsDataURL(file);
	});
}

// CLICK
dropzone.addEventListener('click', () => fileInput.click());

// INPUT
fileInput.addEventListener('change', () => addFiles(fileInput.files));

// DRAG OVER
dropzone.addEventListener('dragover', e => {
	e.preventDefault();
	dropzone.classList.add('dragover');
});

// DRAG LEAVE
dropzone.addEventListener('dragleave', () => {
	dropzone.classList.remove('dragover');
});

// DROP
dropzone.addEventListener('drop', e => {
	e.preventDefault();
	dropzone.classList.remove('dragover');
	addFiles(e.dataTransfer.files);
});


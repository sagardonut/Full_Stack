const API_URL = "http://localhost:3000/movies";
const movieListDiv = document.getElementById("movie-list");
const searchInput = document.getElementById("search-input");
const form = document.getElementById("add-movie-form");

let allMovies = [];

function renderMovies(moviesToDisplay) {
	movieListDiv.innerHTML = "";

	if (moviesToDisplay.length === 0) {
		movieListDiv.innerHTML = "<p>No movies found matching your criteria.</p>";
		return;
	}

	moviesToDisplay.forEach((movie) => {
		const movieElement = document.createElement("div");
		movieElement.classList.add("movie-item");

		movieElement.innerHTML = `
      <p><strong>${movie.title}</strong> (${movie.year}) - ${movie.genre}</p>
      <button class="edit-btn" data-id="${movie.id}">Edit</button>
      <button class="delete-btn" data-id="${movie.id}">Delete</button>
    `;

		movieListDiv.appendChild(movieElement);
	});

	attachActionButtons();
}

function attachActionButtons() {
	document.querySelectorAll(".edit-btn").forEach((btn) => {
		btn.addEventListener("click", () => {
			const id = btn.dataset.id;
			const movie = allMovies.find((m) => m.id == id);
			editMoviePrompt(movie);
		});
	});

	document.querySelectorAll(".delete-btn").forEach((btn) => {
		btn.addEventListener("click", () => {
			const id = btn.dataset.id;
			deleteMovie(id);
		});
	});
}

function fetchMovies() {
	fetch(API_URL)
		.then((response) => response.json())
		.then((movies) => {
			allMovies = movies;
			renderMovies(allMovies);
		})
		.catch((error) => console.error("Error fetching movies:", error));
}

fetchMovies();

searchInput.addEventListener("input", function () {
	const searchTerm = searchInput.value.toLowerCase();

	const filteredMovies = allMovies.filter((movie) => {
		return (
			movie.title.toLowerCase().includes(searchTerm) ||
			movie.genre.toLowerCase().includes(searchTerm)
		);
	});

	renderMovies(filteredMovies);
});

form.addEventListener("submit", function (event) {
	event.preventDefault();

	const newMovie = {
		title: document.getElementById("title").value,
		genre: document.getElementById("genre").value,
		year: parseInt(document.getElementById("year").value),
	};

	fetch(API_URL, {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify(newMovie),
	})
		.then((response) => response.json())
		.then(() => {
			form.reset();
			fetchMovies();
		})
		.catch((error) => console.error("Error adding movie:", error));
});

// EDIT
function editMoviePrompt(movie) {
	const newTitle = prompt("Enter new Title:", movie.title);
	const newYear = prompt("Enter new Year:", movie.year);
	const newGenre = prompt("Enter new Genre:", movie.genre);

	if (!newTitle || !newYear || !newGenre) return;

	const updatedMovie = {
		id: movie.id,
		title: newTitle,
		year: parseInt(newYear),
		genre: newGenre,
	};

	updateMovie(movie.id, updatedMovie);
}

function updateMovie(movieId, updatedMovieData) {
	fetch(`${API_URL}/${movieId}`, {
		method: "PUT",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify(updatedMovieData),
	})
		.then((res) => res.json())
		.then(() => fetchMovies())
		.catch((err) => console.error("Error updating movie:", err));
}

// DELETE
function deleteMovie(movieId) {
	fetch(`${API_URL}/${movieId}`, {
		method: "DELETE",
	})
		.then(() => fetchMovies())
		.catch((error) => console.error("Error deleting movie:", error));
}

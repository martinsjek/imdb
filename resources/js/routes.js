import Movies from "./pages/Movies";
import Movie from "./pages/Movie";

export const routes = [
    {
        path: '/', component: Movies, name: 'Movies',
    },
    {
        path: '/:id', component: Movie, name: 'Movie',
    }
]

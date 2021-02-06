import Movies from "./pages/Movies";
import Movie from "./pages/Movie";

export const routes = [
    {
        path: '/',
        component: Movies,
        name: 'Movies',
        children: [
            {path: ':id', component: Movie, name: 'Movie'}
        ]
    }
]

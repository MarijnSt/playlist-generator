export type PlaylistData = {
    id: string;
    name: string;
    image: string | null;
    count: number;
};
export type PlaylistsData = {
    playlists: Array<PlaylistsData> | null;
    count: number;
};

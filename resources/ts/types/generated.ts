export type CreateData = {
    name: string;
};
export type GenerateData = {
    length: number;
    playlists: Array<PlaylistsData>;
};
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
export type SongData = {
    id: string;
    uri: string;
    name: string;
    artist: string;
    duration_ms: string;
    duration_formatted: string;
    image: string;
};

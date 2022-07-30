import Tag from "./Tag";
import User from "./User";

interface Note {
    id: Number;
    title: string;
    description: string;
    created_at: string;
    user: User;
    tags: Tag[];
}

export default Note;
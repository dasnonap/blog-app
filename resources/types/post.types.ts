import { User } from 'types/user.types';

export interface Post {
	id: string;
	slug: string | null;
	title: string;
	createdAt: string;
	liked: boolean;
	likes: number;
	disliked: boolean;
	dislikes: number;
	user: User;
}

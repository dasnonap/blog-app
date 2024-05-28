import { Link } from '@inertiajs/react';
import { Post } from 'types/post.types';

const Card = ({ id, slug, title, createdAt, liked, likes, disliked, dislikes, user, tags }: Post) => {
	return (
		<div className="card flex flex-col shadow-xl p-6 pb-8 bg-white h-full">
			<img className="aspect-[1/.34] object-cover mb-8" src="https://picsum.photos/800/600" alt={title} />

			<div className="flex gap-2 mb-3">
				{tags?.map((tag, index) => {
					return (
						<span key={`${index}-${tag}`} className="tag text-indigo-600 font-semibold">
							{tag}
						</span>
					);
				})}
			</div>

			<Link href={`posts/${slug}`} className="text-2xl mb-3 font-semibold">{title}</Link>

			<div className="text-base mb-14 text-gray-600">No excerpt</div>

			<div className="flex items-center gap-3 mt-auto">
				<img className="w-10 basis-10 aspect-square object-cover rounded-full" src="https://picsum.photos/800/600" alt={user.name} />

				<div>
					<div className="text-sm font-semibold">{user.name}</div>

					<div className="text-sm text-gray-600">{createdAt}</div>
				</div>
			</div>
		</div>
	);
};

export default Card;

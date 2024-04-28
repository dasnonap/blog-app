import { Link, Head } from '@inertiajs/react';
import { fetchPosts } from '../../mock/posts';
import Card from '@/Components/Card';
import { useEffect, useState } from 'react';

export default function Feed() {
	const [posts, setPosts] = useState([]);

	useEffect(() => {
		fetchPosts().then((data) => {
			setPosts(data);
		});
	}, []);

	const postItems = posts.map((post) => (
		<div className="mt-16 first:mt-0">
			<Card
				key={post.id}
				title={post.title}
				excerpt={post.excerpt}
				imageUrl={post.imageUrl}
				user={post.user}
				tags={post.tags}
			></Card>
		</div>
	));

	return (
		<>
			<Head title="Feed" />

			<div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
				<div className="sidebar">Sidebar</div>

				<div className="container max-w-screen-md py-10">
					{postItems && postItems.length > 0 && postItems}
				</div>
			</div>

		</>
	);
}

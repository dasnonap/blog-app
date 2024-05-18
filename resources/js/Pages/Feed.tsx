import { Link, Head } from '@inertiajs/react';
import { fetchPosts } from '../../mock/posts';
import Card from '@/Components/Card';
import { useEffect, useRef, useState } from 'react';
import InfiniteScrollLoader from '@/Components/InfiniteScrollLoader';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Sidebar from '@/Components/sidebar';

// TODO: Extract nav into components
// TODO: On render - fetch relevant posts, based on filter
// TODO: Implement search functionality
// TODO: Add caching
// TODO: Add pagination

interface Post {
	id: number;
	title: string;
	excerpt: string;
	imageUrl: string;
}

export default function Feed({ auth }) {
	const containerRef = useRef(null);
	const bottomRef = useRef(null);
	const [posts, setPosts] = useState([]);
	const [search, setSearch] = useState('');
	const [filter, setFilter] = useState('');
	const [loadingPosts, setLoadingPosts] = useState(false);

	const arr: Post[] = [];

	useEffect(() => {
		fetchPosts().then((data) => {
			setPosts(data);
		});

		const options = {
			rootMargin: '1px',
		};

		const handleBottomIntersection = (entries, observer) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					setLoadingPosts(true);

					fetchPosts().then((nextPosts) => {
						setPosts((prevPosts) => [...prevPosts, ...nextPosts]);
						setLoadingPosts(false);
					});
				}
			});
		};

		const observer = new IntersectionObserver(
			handleBottomIntersection,
			options
		);

		observer.observe(bottomRef.current);
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
		<AuthenticatedLayout
			user={auth.user}
			header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Feed</h2>}
		>
			<Head title="Feed" />

			<div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
				<Sidebar />

				<div
					className="container max-w-screen-md pt-10"
					ref={containerRef}
				>
					{postItems && postItems.length > 0 && postItems}

					<div ref={bottomRef}></div>

					{loadingPosts && (
						<div className="flex justify-center">
							<InfiniteScrollLoader />
						</div>
					)}
				</div>
			</div>
		</AuthenticatedLayout>
	);
}

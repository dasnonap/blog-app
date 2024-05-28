import { Link, Head } from '@inertiajs/react';
import Card from '@/Components/Card';
import { useEffect, useRef, useState } from 'react';
import InfiniteScrollLoader from '@/Components/InfiniteScrollLoader';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Sidebar from '@/Components/sidebar';
import { fetchPosts } from 'mock/posts';
import { Post } from 'types/post.types';

// TODO: Extract nav into components
// TODO: Add filters
// TODO: On render - fetch relevant posts, based on filter
// TODO: Implement search functionality
// TODO: Add caching
// TODO: Add pagination

export default function Feed({ auth }) {
	const containerRef = useRef(null);
	const bottomRef = useRef(null);
	const [posts, setPosts] = useState<Post[]>([]);
	const [search, setSearch] = useState('');
	const [filter, setFilter] = useState('');
	const [loadingPosts, setLoadingPosts] = useState(false);

	useEffect(() => {
		fetchPosts()
			.then((posts: Post[]) => {
				setPosts(posts);
			})
			.catch(console.error);

		const options = {
			rootMargin: '1px',
		};

		const handleBottomIntersection = (
			entries: IntersectionObserverEntry[],
			observer: IntersectionObserver
		) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					setLoadingPosts(true);

					fetchPosts().then((nextPosts: Post[]) => {
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

		if (bottomRef.current) {
			observer.observe(bottomRef.current);
		}
	}, []);

	const postItems = posts.map((post) => (
		<div
			key={post.id}
			className="mt-16 first:mt-0 xl:flex-[1_0_calc(50%-2rem)] xl:mt-0"
		>
			<Card
				id={post.id}
				slug={post.slug}
				title={post.title}
				createdAt={post.createdAt}
				liked={post.liked}
				likes={post.likes}
				disliked={post.disliked}
				dislikes={post.dislikes}
				user={post.user}
			></Card>
		</div>
	));

	return (
		<AuthenticatedLayout
			user={auth.user}
			header={
				<h2 className="font-semibold text-xl text-gray-800 leading-tight">
					Feed
				</h2>
			}
		>
			<Head title="Feed" />

			<div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
				<Sidebar />

				<div
					className="container max-w-screen-md xl:max-w-screen-xl pt-10 xl:flex flex-wrap gap-8"
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

import { Link, Head } from '@inertiajs/react';
import { fetchPosts } from '../../mock/posts';
import Card from '@/Components/Card';
import { useEffect, useRef, useState } from 'react';
import AnimeSvg from '../../assets/anime.svg';
import InfiniteScrollLoader from '@/Components/InfiniteScrollLoader';

// TODO: Extract nav into components
// TODO: On render - fetch relevant posts, based on filter
// TODO: Implement search functionality
// TODO: Add caching
// TODO: Add pagination

export default function Feed() {
	const containerRef = useRef(null);
	const bottomRef = useRef(null);
	const [posts, setPosts] = useState([]);
	const [search, setSearch] = useState('');
	const [filter, setFilter] = useState('');
	const [loadingPosts, setLoadingPosts] = useState(false);

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

	const handleClick = (e) => {
		const { filter } = e.currentTarget.dataset;
		setFilter(filter);
	};

	return (
		<>
			<Head title="Feed" />

			<div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
				<div className="sidebar py-8 px-6">
					<input type="search" />

					<nav>
						<ul className="flex flex-col gap-1 mt-4">
							<li>
								<button
									className="flex items-center gap-1"
									onClick={handleClick}
									data-filter="anime"
								>
									<i className="ico">
										<img
											src={AnimeSvg}
											width={32}
											height={32}
										/>
									</i>

									<p>Anime</p>
								</button>
							</li>

							<li>
								<button
									className="flex items-center gap-1"
									onClick={handleClick}
									data-filter="movies"
								>
									<i className="ico">
										<img
											src={AnimeSvg}
											width={32}
											height={32}
										/>
									</i>

									<p>Movies</p>
								</button>
							</li>

							<li>
								<button
									className="flex items-center gap-1"
									onClick={handleClick}
									data-filter="music"
								>
									<i className="ico">
										<img
											src={AnimeSvg}
											width={32}
											height={32}
										/>
									</i>

									<p>Music</p>
								</button>
							</li>

							<li>
								<button
									className="flex items-center gap-1"
									onClick={handleClick}
									data-filter="data"
								>
									<i className="ico">
										<img
											src={AnimeSvg}
											width={32}
											height={32}
										/>
									</i>

									<p>Data</p>
								</button>
							</li>
						</ul>
					</nav>
				</div>

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
		</>
	);
}

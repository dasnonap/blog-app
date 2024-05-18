import { Link } from '@inertiajs/react';
import AnimeSvg from 'assets/anime.svg';

const Sidebar = () => {
	return (
		<div className="sidebar py-8 px-6 bg-white border-r border-gray-100">
			<input type="search" />

			<nav>
				<ul className="flex flex-col gap-1 mt-4">
					<li>
						<Link
							href="/posts/anime"
							className="flex items-center gap-1"
						>
							<i className="ico">
								<img src={AnimeSvg} width={32} height={32} />
							</i>

							<p>Anime</p>
						</Link>
					</li>

					<li>
						<Link
							href="posts/movies"
							className="flex items-center gap-1"
						>
							<i className="ico">
								<img src={AnimeSvg} width={32} height={32} />
							</i>

							<p>Movies</p>
						</Link>
					</li>

					<li>
						<Link
							href="posts/music"
							className="flex items-center gap-1"
						>
							<i className="ico">
								<img src={AnimeSvg} width={32} height={32} />
							</i>

							<p>Music</p>
						</Link>
					</li>

					<li>
						<Link
							href="posts/data"
							className="flex items-center gap-1"
						>
							<i className="ico">
								<img src={AnimeSvg} width={32} height={32} />
							</i>

							<p>Data</p>
						</Link>
					</li>
				</ul>
			</nav>
		</div>
	);
};

export default Sidebar;

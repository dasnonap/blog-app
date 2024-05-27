import { useState } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';
import { Menu } from '@headlessui/react';
import Logo from 'assets/logo.svg';

console.log({ Logo });

export default function Authenticated({ user, header, children }) {
	console.log({ user });

	const [showingNavigationDropdown, setShowingNavigationDropdown] =
		useState(false);

	return (
		<>
			<header className="px-6 py-3 bg-white border-b border-gray-100 z-100 relative">
				<div className="flex justify-between items-center">
					<div className="flex gap-6 items-center">
						<Link href="/">
							<img className="w-14" src={Logo} alt="Discourse" />
						</Link>

						<nav>
							<ul className="flex gap-6">
								<li>
									<Link
										className="text-gray-700 font-semibold"
										href="/"
									>
										Home
									</Link>
								</li>

								<li>
									<Link
										className="text-gray-700 font-semibold"
										href="/posts"
									>
										My Posts
									</Link>
								</li>

								<li>
									<Link
										className="text-gray-700 font-semibold"
										href="/bookmarks"
									>
										Bookmarks
									</Link>
								</li>

								<li>
									<Link
										className="text-gray-700 font-semibold"
										href="/users"
									>
										Users
									</Link>
								</li>
							</ul>
						</nav>
					</div>

					<Menu>
						<div className="relative inline-block">
							<Menu.Button>
								<img
									className="w-10 rounded-full border-2 border-sky-50 shadow-md"
									src="https://i.pravatar.cc/300"
									alt={`${user.name}'s avatar`}
								/>
							</Menu.Button>

							<Menu.Items
								className="absolute z-[60] top-full right-0 bg-white border border-gray-100 rounded-lg text-sm font-medium w-max"
								anchor="bottom"
							>
								<div className="px-4 py-3">
									<div className="flex gap-3">
										<img
											className="w-10 rounded-full border-2 border-sky-50 shadow-md"
											src="https://i.pravatar.cc/300"
											alt={`${user.name}'s avatar`}
										/>

										<div>
											<div className="font-semibold">
												{user.name}
											</div>

											<div className="font-normal text-gray-600">
												{user.email}
											</div>
										</div>
									</div>
								</div>

								<div className="border-t border-gray-100">
									<Menu.Item>
										<Link
											href="/"
											className="text-gray-700 block px-4 py-2 hover:bg-gray-100"
										>
											View profile
										</Link>
									</Menu.Item>

									<Menu.Item>
										<Link
											href="/"
											className="text-gray-700 block px-4 py-2 hover:bg-gray-100"
										>
											Settings
										</Link>
									</Menu.Item>

									<Menu.Item>
										<Link
											href="/"
											className="text-gray-700 block px-4 py-2 hover:bg-gray-100"
										>
											Bookmarks
										</Link>
									</Menu.Item>
								</div>

								<div className="border-t border-gray-100">
									<Menu.Item>
										<Link
											href="/"
											className="text-gray-700 block px-4 py-2 hover:bg-gray-100 rounded-bl-lg rounded-br-lg"
										>
											Logout
										</Link>
									</Menu.Item>
								</div>
							</Menu.Items>
						</div>
					</Menu>
				</div>
			</header>

			<main>{children}</main>
		</>
	);
}

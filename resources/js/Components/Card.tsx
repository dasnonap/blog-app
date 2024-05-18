const Card = ({ title, excerpt, imageUrl, user, tags }) => {
	return (
		<div className="card shadow-xl p-6 pb-8 bg-white">
			<img className="aspect-[1/.34] object-cover mb-8" src={imageUrl} alt={title} />

			<div className="flex gap-2 mb-3">
				{tags.map((tag, index) => {
					return (
						<span key={`${index}-${tag}`} className="tag text-indigo-600 font-semibold">
							{tag}
						</span>
					);
				})}
			</div>

			<div className="text-2xl mb-3 font-semibold">{title}</div>

			<div className="text-base mb-14 text-gray-600">{excerpt}</div>

			<div className="flex items-center gap-3">
				<img className="w-10 basis-10 aspect-square object-cover rounded-full" src={imageUrl} alt={user} />

				<div>
					<div className="text-sm font-semibold">{user}</div>

					<div className="text-sm text-gray-600">20 Jan 2022</div>
				</div>
			</div>
		</div>
	);
};

export default Card;

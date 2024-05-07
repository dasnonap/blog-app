const posts = [
	{
		id: '1',
		title: 'UX review presentations',
		excerpt:
			'How do you create compelling presentations that wow your colleagues and impress your managers?',
		imageUrl: 'https://picsum.photos/800/600',
		user: 'CodeCraftsman',
		tags: ['ReactJS', 'TailwindCSS', 'JavaScript'],
	},
	{
		id: '2',
		title: 'Effective Time Management Techniques',
		excerpt:
			'Discover the secrets to managing your time effectively and boosting productivity.',
		imageUrl: 'https://picsum.photos/800/601',
		user: 'ByteBrewer',
		tags: ['Python', 'Django'],
	},
	{
		id: '3',
		title: 'Mastering Remote Team Collaboration',
		excerpt:
			'Learn how to foster effective collaboration within your remote team and achieve better results.',
		imageUrl: 'https://picsum.photos/800/602',
		user: 'ScriptSavvy',
		tags: ['Cloud', 'AWS', 'DevOps'],
	},
	{
		id: '4',
		title: 'The Art of Persuasive Writing',
		excerpt:
			'Unlock the power of persuasive writing techniques to influence your audience and achieve your goals.',
		imageUrl: 'https://picsum.photos/800/603',
		user: 'DevExplorer',
		tags: ['Cyber Security', 'Ethical Hacking'],
	},
	{
		id: '5',
		title: 'Introduction to Data Science',
		excerpt:
			'Get started on your journey to becoming a data scientist with this comprehensive introduction.',
		imageUrl: 'https://picsum.photos/800/604',
		user: 'TechJunkie',
		tags: ['UI', 'UX', 'Design'],
	},
];

export const fetchPosts = () => {
	return new Promise((resolve) => {
		setTimeout(() => {
			resolve(posts);
		}, 1000);
	});
};

application:应用目录
		admin:后台的相关文件
			controller:控制器
			model:模型
			validate:字段验证
			view:视图，即后台的页面设计
				.../  各文件夹按照菜单的功能划分
		api：接口相关
		home:用户访问前端
			controller:
			model:
			validate:
			view:
		index:后台登录后的主页面，可以不用
data：空文件夹
extend：扩展库文件、插件等存放位置
public:公共内容
	data 
	sldata
	static 静态文件存放区
	swagger
	ueditor 所用编辑器插件
	uploads 上传目录
runtime:系统的运行时产生的缓存文件
thinkphp:thinkphp 核心目录，一般不用修改
vendor:第三方库存放区，和extend重复，系统默认为此目录。

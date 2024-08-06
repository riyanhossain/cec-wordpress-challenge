# WordPress Challenge

Welcome to the CEC's WordPress Development Challenge! This test aims to evaluate your skills in WordPress and PHP development. Your task is to create a plugin or theme that implements a paywall gate for posts.

## Requirements

1. **User Roles**: Add three user roles - Free Reader, Paid Reader, and Premium Reader.
2. **User Registration**: Enable public user registration and set Free Reader as the default role.
3. **Post Metabox**: Add a metabox to the post form to select which role can read the full article.
4. **Paywall Gate**: If a user does not have the required permission to read the post, display a paywall gate showing only the post excerpt.
5. **Premium Content Restriction**: Posts marked as premium should not be listed for users who do not have the Premium Reader role.

## Instructions

1. **Create the Plugin/Theme**:
    - Initialize a new plugin/theme in your WordPress setup.

2. **Add User Roles**:
    - Add the roles Free Reader, Paid Reader, and Premium Reader.

3. **Enable Public Registration**:
    - Enable user registration from the WordPress settings.
    - Set Free Reader as the default role for new users.

4. **Add Post Metabox**:
    - Add a metabox to the post edit screen to select the user role required to read the full article.
    - Save this information as post metadata.

5. **Implement Paywall Gate**:
    - Modify the post content based on the user's role.
    - If the user does not have the required role, display the post excerpt followed by a paywall message.

6. **Restrict Premium Content**:
    - Ensure that posts marked as premium are not listed for users without the Premium Reader role.

## Submission

- Fork the repository containing this README.
- Provide a link to the public repository containing your code.
- Ensure your repository includes a README with instructions on how to install and use the plugin/theme.

## Evaluation Criteria

- **Code Quality**: Clean, readable, and well-documented code.
- **Functionality**: All listed features work as expected.
- **UI/UX**: The user interface is intuitive and visually appealing.
- **Performance**: Efficient handling of user roles and content restriction.
- **Completion**: Adherence to the requirements and instructions provided.

## Doubts?

Do you have any doubts related to the process? Open an [issue](https://github.com/Cutting-Edge-Concepts/cec-wordpress-challenge/issues) and we'll be happy to help.

Good luck, and happy coding!

---

If you have any questions, feel free to reach out.

describe('template spec', () => {
  it('Login', () => {
    cy.visit('http://localhost:5173')
    cy.get("input[name=email]").type("test@demo.cz")
    cy.get("input[name=password]").type("password123")
    cy.intercept('POST', '/login').as('login');
    cy.get("button").click()
    cy.wait(5000)
    cy.wait('@login')
  })
})